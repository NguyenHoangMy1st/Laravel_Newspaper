<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminMenuRequest;
use App\Models\Menu;
use App\Models\SeoBlog;
use App\Service\Seo\RenderUrlSeoBLogService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminMenuController extends Controller
{
    public function index()
    {
        $menus = Menu::orderByDesc('m_sort')
            ->paginate(20);

        $viewData = [
            'menus' => $menus
        ];
        return view('admin.menu.index', $viewData);
    }

    public function create()
    {
        $menus = Menu::orderByDesc('m_sort')->get();

        return view('admin.menu.create',compact('menus'));
    }

    public function store(AdminMenuRequest  $request)
    {
        $data = $request->except(['avatar','save','_token']);
        $data['created_at'] = Carbon::now();

        if(!$request->m_title_seo)             $data['m_title_seo'] = $request->m_name;
        if(!$request->m_description_seo) $data['m_description_seo'] = $request->m_name;

        $menuID = Menu::insertGetId($data);
        if($menuID)
        {
            RenderUrlSeoBLogService::init($request->m_slug,SeoBlog::TYPE_MENU, $menuID);
            return redirect()->route('get_admin.menu.index');
        }

        return  redirect()->back();
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $menus = Menu::orderByDesc('m_sort')->get();
        return view('admin.menu.update',compact('menu','menus'));
    }

    public function update(AdminMenuRequest $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $data = $request->except(['avatar','save','_token','c_position_1']);
        $data['updated_at'] = Carbon::now();

        if(!$request->m_title_seo)             $data['m_title_seo'] = $request->m_name;
        if(!$request->m_description_seo) $data['m_description_seo'] = $request->m_name;

        $menu->fill($data)->save();
        RenderUrlSeoBLogService::init($request->m_slug,SeoBlog::TYPE_MENU, $id);
        return redirect()->route('get_admin.menu.index');
    }


    public function delete(Request $request, $id)
    {
        if($request->ajax())
        {
            $menu = Menu::findOrFail($id);
            if ($menu)
            {
                $menu->delete();
                RenderUrlSeoBLogService::deleteUrlSeo(SeoBlog::TYPE_MENU, $id);
            }
            return response()->json([
                'status' => 200,
                'message' => 'Xoá dữ liệu thành công'
            ]);
        }

        $menu = Menu::findOrFail($id);
        if ($menu)
        {
            $menu->delete();
            RenderUrlSeoBLogService::deleteUrlSeo(SeoBlog::TYPE_MENU, $id);
        }

        return  redirect()->back();
    }
}
