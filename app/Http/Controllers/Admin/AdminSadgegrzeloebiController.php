<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SadgegrzeloRequest;
use App\Support\Admin\AdminDestroy;
use Models\Collection;
use Models\SadgegrzeloCategory;
use Models\Sadgegrzeloebi;

class AdminSadgegrzeloebiController extends Controller
{
    use Positionable, VisibilityTrait, Transferable;

    /**
     * The Sadgegrzeloebi instance.
     *
     * @var \Models\Sadgegrzeloebi
     */
    protected $model;

    /**
     * Create a new controller instance.
     *
     * @param  \Models\Sadgegrzeloebi  $model
     * @return void
     */
    public function __construct(Sadgegrzeloebi $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $collectionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($collectionId)
    {
        $data['parent'] = (new Collection)->where('type', Sadgegrzeloebi::TYPE)
            ->findOrFail($collectionId);

        $data['items'] = $this->model->hasFile()->getAdminCollection($data['parent']);

        $data['parentSimilar'] = $this->model->byType()->get();

        return view('admin.collections.sadgegrzeloebi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  int  $collectionId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($collectionId)
    {
        $data['current'] = $this->model;
        $data['current']->collection_id = $collectionId;

        return view('admin.collections.sadgegrzeloebi.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SadgegrzeloRequest  $request
     * @param  int  $collectionId
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(SadgegrzeloRequest $request, $collectionId)
    {
        $input = $request->all();
        $input['collection_id'] = $collectionId;

        $model = $this->model->create($input);
        foreach ($request->get('categories') as $category_id){
            SadgegrzeloCategory::insert([
                'sadgegrzeloebi_id' => $model->id,
                'category_id' => $category_id,
            ]);
        }

        return redirect(cms_route('sadgegrzeloebi.edit', [$collectionId, $model->id]))
            ->with('alert', fill_data('success', trans('general.created')));
    }

    /**
     * Display the specified resource.
     *
     * @return void
     */
    public function show()
    {
        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $collectionId
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($collectionId, $id)
    {
        $data['items'] = $this->model->joinLanguage(false)
            ->where('id', $id)
            ->getOrFail();

        return view('admin.collections.sadgegrzeloebi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Admin\SadgegrzeloRequest  $request
     * @param  int  $collectionId
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(SadgegrzeloRequest $request, $collectionId, $id)
    {
        $this->model->findOrFail($id)->update($input = $request->all());

        SadgegrzeloCategory::where('sadgegrzeloebi_id', $id)->delete();
        foreach ($request->get('categories') as $category_id){
            SadgegrzeloCategory::insert([
                'sadgegrzeloebi_id' => $id,
                'category_id' => $category_id,
            ]);
        }

        if ($request->expectsJson()) {
            return response()->json(fill_data(
                'success', trans('general.updated'), $input
            ));
        }

        return redirect()->back()->with('alert', fill_data(
            'success', trans('general.updated')
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $collectionId
     * @param  int  $id
     * @return mixed
     */
    public function destroy($collectionId, $id)
    {
        return (new AdminDestroy($this->model, $id))->handle();
    }
}
