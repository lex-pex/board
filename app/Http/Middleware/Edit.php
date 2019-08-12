<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Ad;

class Edit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($id = $request->route('id'))
            $ad = Ad::find($id);
        else
            $ad = $request->route('ad');
        if(!$ad) abort(404);
        if(!$u = $request->user())
            return redirect()->back()->with(['status' => 'You have no rights to Edit']);
        $userId = $u->id;
        $role = $u->role;
        $authorId = $ad->user_id;
        if($role != 'admin')
            if ($userId != $authorId)
                return redirect()->back()->with(['status' => 'You have no rights to Edit']);
        return $next($request);
    }
}
