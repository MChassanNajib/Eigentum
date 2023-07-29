<?php

namespace App\Http\Controllers;

use App\Helper\ApiFormatter;
use App\Models\Agent;
use App\Models\District;
use App\Models\Property;
use App\Models\Province;
use App\Models\Regency;
use App\Models\Village;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AgentController extends Controller
{

    public function index()
    {
        $agents = Agent::paginate(5);
        $tables = (new Agent())->getTable();

        if ($agents) {
            return view('admin.agent.all', compact('agents', 'tables'));
        }
    }


    public function create()
    {
        $provinces = Province::all();
        $regencies = Regency::all();
        $districts = District::all();
        $villages = Village::all();
        
        
        return view('admin.agent.create', compact('provinces', 'regencies', 'districts', 'villages'));
    }

    public function store(Request $request)
    {
            $request->validate([
                'email' => 'required|email|unique:agents',
                'password'  => 'required|min:8',
                'name'    => 'required',
                'address'   => 'required',
                'ktp'    => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
                'face'    => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:10240',
                'telp' => 'required|regex:/^[0-9+\-() ]+$/',
            ],[
                'email.required' => 'Email tidak boleh kosong',
                'email.unique' => 'Email sudah terdaftar',
                'password.required' => 'Password tidak boleh kosong',
                'password.min' => 'Password minimal 8 karakter',
                'name.required' => 'Nama tidak boleh kosong',
                'address.required' => 'Alamat tidak boleh kosong',
                'ktp.required' => 'KTP tidak boleh kosong',
                'ktp.image' => 'KTP harus berupa gambar',
                'ktp.mimes' => 'KTP harus berupa file dengan format jpg, png, jpeg, gif, svg',
                'ktp.max' => 'Ukuran KTP maksimal 10MB',
                'face.required' => 'Foto tidak boleh kosong',
                'face.image' => 'Foto harus berupa gambar',
                'face.mimes' => 'Foto harus berupa file dengan format jpg, png, jpeg, gif, svg',
                'face.max' => 'Ukuran Foto maksimal 10MB',
                'telp.required' => 'Nomor telepon tidak boleh kosong',
                'telp.regex' => 'Nomor telepon tidak valid',
            ]);
            
            $imageArray = [];
                foreach ((['ktp', 'face']) as $fieldName) {
                    $imageFileName = Str::random(8) . "." . $request->$fieldName->getClientOriginalExtension();
                    $imageArray[] = $imageFileName;
                    $request->$fieldName->storeAs('public', $imageFileName);
                }

            // Ambil province_id dari tabel pivot agent_province berdasarkan agent_id
            $regencyId = $request->regencies_id;
            $randomProperty = Property::whereHas('regencies', function ($query) use ($regencyId) {
                $query->where('regency_id', $regencyId);
            })->inRandomOrder()->first();

            if (!$randomProperty) {
                return redirect()->back()->with('error', 'Tidak ada agen yang tersedia untuk properti ini');
            }

            $agent = Agent::create([
                'email' => $request->email,
                'password'  => bcrypt($request->password),
                'name'  => $request->name,
                'address'   => $request->address,
                'ktp'   => $imageArray[0],
                'face'   => $imageArray[1],
                'telp'  => $request->telp,
            ]);

            $agent->save();
            
            $agent->properties()->attach($randomProperty->id);
            $agent->provinces()->attach($request->provinces_id);
            $agent->regencies()->attach($request->regencies_id);
            $agent->districts()->attach($request->districts_id);
            $agent->villages()->attach($request->villages_id);
            
            $agent = Agent::where('id', '=', $agent->id)->get();
            
            if ($agent) {
                return redirect(route('agent.index'));
            } 

        
    }

    public function show(Agent $agent)
    {
        return view('admin.agent.detail', compact('agent'));
    }

    public function edit(Agent $agent)
    {
        return view('admin.agent.edit', compact('agent'));
    }


    public function update(Request $request,string $id)
    {
        
            $request->validate([
                'name'    => 'required',
                'email' => 'nullable|email',
                'password'  => 'nullable|min:8',
                'address'   => 'required',
                'ktp'    => 'nullable|mimes:jpg,png,jpeg,gif,svg|max:10240',
                'face'    => 'nullable|mimes:jpg,png,jpeg,gif,svg|max:10240',
                'telp' => 'nullable|regex:/^[0-9+\-() ]+$/',
            ]);

            $agent = Agent::findOrfail($id);

            $agent->update([
                'name'  => $request->name,
                'email' => $request->email,
                'password'  => bcrypt($request->password),
                'address'   => $request->address,
                'telp'  => $request->telp,
            ]);

            $images = ['ktp', 'face'];
                foreach ($images as $key => $image) {
                    if ($request->hasFile($image)) {
                        $imageName = $request->{$image}->getClientOriginalName(). "." . $request->{$image}->getClientOriginalExtension();
                        $image_path = Storage::disk('public')->put($imageName, file_get_contents($request->{$image}));
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                        $agent->{$image} = $imageName;
                    }
            }

            $agent->save();


            $agent = Agent::where('id', '=', $agent->id)->get();
            return redirect(route('agent.show', $id));
        
    }


    public function destroy(string $id)
    {
        
            $agent = Agent::findOrfail($id);
            $agent->properties()->detach();
            $agent->provinces()->detach();
            $agent->regencies()->detach();
            $agent->districts()->detach();
            $agent->villages()->detach();
            $agent = $agent->delete();

            if ($agent) {
                return  redirect(route('agent.index'));
            } 
        
    }
}
