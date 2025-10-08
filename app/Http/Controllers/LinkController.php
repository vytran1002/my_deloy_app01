<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Str;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');
        $links = Link::when($q, fn($qr)=>$qr->where('long_url', 'like', "%$q%"))
            ->orderByDesc('created_at')
            ->paginate(10)
            ->withQueryString();
            return Inertia::render('Links/Index', [
                'links' => $links,
                'q'=>$q,
                'base'=>config('app.url'),
            ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'long_url' => 'required|url|max:2048',
        ]);
        $code = $this->uniqueCode();
        $link = Link::create([
            'code' => $code,
            'long_url' => $data['long_url'],
            'clicks' => 0,
        ]);
        return redirect()->back()->with('success', "Short link created! ");
    }

    public function destroy(Link $link){
        $link->delete();
        return redirect()->back()->with('success', "Link deleted!");
    }

     public static function uniqueCode($len = 6): string{
        do{
            $code = Str::lower(Str::random($len));
        }while(Link::where('code',$code)->exists());
        return $code;
      
    }
    
}
