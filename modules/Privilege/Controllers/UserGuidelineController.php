<?php

namespace Modules\Privilege\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Configuration\Repositories\GuidelineRepository;
use Modules\Privilege\Repositories\UserRepository;

class UserGuidelineController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  GuidelineRepository $guidelines
     * @param  UserRepository $users
     * @return void
     */
    public function __construct(
        GuidelineRepository $guidelines,
        UserRepository $users
    )
    {
        $this->guidelines = $guidelines;
        $this->users = $users;
    }

    /**
     * Display a listing of the delegation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authUser = auth()->user();
        $guidelines = $this->guidelines->select(['*'])
            ->orderby('published_at', 'desc')
            ->get();
        return view('Privilege::Guideline.index')
            ->withGuidelines($guidelines)
            ->withUser(auth()->user());
    }
    public function guidelinescheck()
    {
        $authUser = auth()->user();
        $guidelines = $this->guidelines->select(['*'])
            ->whereDate('published_at', '<=', date('Y-m-d'))
            ->whereDate('expired_at', '>=', date('Y-m-d'))
            ->whereNotIn('id', $authUser->guidelines->pluck('id'))
            ->orderby('published_at', 'desc')
            ->get();
        return view('Privilege::Guideline.index')
            ->withGuidelines($guidelines)
            ->withUser(auth()->user());
    }

    public function show($id)
    {
        $guideline = $this->guidelines->find($id);
        if($guideline){
            $authUser = auth()->user();
            $authUser->guidelines()->sync($guideline->id, false);
            return view('Privilege::Guideline.show')
                ->withGuideline($guideline);
        }
    }
}
