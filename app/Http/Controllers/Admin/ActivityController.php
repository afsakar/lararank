<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

class ActivityController extends Controller
{
    /**
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.activities.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $activity = Activity::where('id', $id)->first() ?? abort(404);

        $activity->delete();
        return redirect()->route('activities.index')->withSuccess('Kayıt veritabanından başarıyla silindi!');
    }

    /**
     * @return mixed
     */
    public function deleteAll()
    {
        $activity = Activity::truncate();
        return redirect()->route('activities.index')->withSuccess('Kayıtlar veritabanından başarıyla silindi!');
    }
}
