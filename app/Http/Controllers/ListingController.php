<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
class ListingController extends Controller
{
    public function index(){
        return view('listings.index', ['heading'=>'Latest Listings',
        'listings'=> Listing::latest()->filter(request(['tag','search']))->paginate(4)
    ]);
    }

    public function show(Listing $listing){
        return view('listings.show', ['listing'=>$listing]);

    }

    public function create(){
        return view('listings.create');
    }

    public function store(Request $request)
    {
        // Validate the form data
        $formFields = $request->validate([
            'title' => ['required'],
            'company' => ['required', Rule::unique('listings', 'company')],
            'location' => ['required'],
            'website' => ['required'],
            'email' => ['required', 'email'],
            'tags' => ['required'],
            'description' => ['required']
        ]);

        if($request->hasFile('logo')){
            $request->validate([
                'logo'=>['mimes:png,jpg,jpeg','max:2048']
            ]);
            $fileName = time().'_'.$request->company.'.'. $request->file('logo')->getClientOriginalExtension();
            $filePath = $request->file('logo')->storeAs('logos',$fileName,'public');

            $formFields['logo'] = $filePath;
        }
        $formFields['user_id'] = auth()->user()->id;
        // Create the new listing and store it in the database
        Listing::create($formFields);

        // Redirect to the home page (or other page) with a success message
        return redirect('/')->with('message','Listing Created Successfully!');
    }

    public function edit(Listing $listing){
        if($listing->user_id != auth()->user()->id){
            abort(403,'Unauthorized action is detected');
        }
        return view('listings.edit', ['listing'=>$listing]);
    }

    public function update(Request $request, Listing $listing){

        if($listing->user_id != auth()->user()->id){
            abort(403, "Unauthorized Action");
        }

        $formFields = $request->validate([
            'title' => ['required'],
            'company' => ['required'],
            'location' => ['required'],
            'website' => ['required'],
            'email' => ['required', 'email'],
            'tags' => ['required'],
            'description' => ['required']
        ]);

        if($request->hasFile('logo')){
            $request->validate([
                'logo'=>['mimes:png,jpg,jpeg','max:2048']
            ]);
            $fileName = time().'_'.$request->company.'.'. $request->file('logo')->getClientOriginalExtension();
            $filePath = $request->file('logo')->storeAs('logos',$fileName,'public');

            $formFields['logo'] = $filePath;
        }

        $listing->update($formFields);

        return back()->with('message','Listing updated Successfully!');
    }


    public function destroy(Listing $listing)
    {
        if($listing->user_id != auth()->user()->id){
            abort(403, 'Unauthorized Actions');
        }
        if ($listing->logo) {
            Storage::disk('public')->delete($listing->logo);
        }

        // Delete the listing from the database
        $listing->delete();

        // Redirect with a success message
        return redirect('/')->with('message', 'Listing deleted successfully!');
    }

    public function manage(){
        $listings = Listing::where('user_id', auth()->user()->id)->paginate(2);
        return view('listings.manage', compact('listings'));
    }

}
