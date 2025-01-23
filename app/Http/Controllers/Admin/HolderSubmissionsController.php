<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\HolderSubmission\StoreRequest;
use App\Http\Requests\HolderSubmission\UpdateRequest;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\DataTables\HolderSubmissionsDataTable;
use App\Models\HolderSubmission;
use App\Models\Issuer;
use App\Models\Receiver;
use App\Models\Uploads;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Auth;
use Gate;
use Validator;

class HolderSubmissionsController extends Controller
{
    private $status;

    /**
     * Create a Enums instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->status = config('constant.enums.status');
        $this->folder =  'holdersubmission';
    }


    public function index(HolderSubmissionsDataTable $dataTable)
    {
        abort_if(Gate::denies('holder_submission_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.holder_submissions.list');
        return $dataTable->render('admin.holder_submissions.index', compact('pageTitle'));
    }

    public function create(){
        abort_if(Gate::denies('holder_submission_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle           = trans('panel.page_title.holder_submissions.add');
        $status              = $this->status;
        $issuers = Issuer::pluck('name', 'id');
        $receivers = Receiver::pluck('name', 'id');
        $students    = Student::pluck('name','id');
        return view('admin.holder_submissions.create', compact('pageTitle','status','students','issuers','receivers'));
    }

    public function store(StoreRequest $request)
    {
        $holderSubmission = HolderSubmission::create($request->all());

        // document upload
        $path = public_path('storage/' . $this->folder);
        if (!File::isDirectory($path)) {
            $path =   Storage::disk('public')->makeDirectory($this->folder);
        }

        $files = array_keys(config('constant.holder_submission_documents'));
        foreach ($files as $key => $file) {
            if ($request->hasFile($file)){
                $fileData = $request->file($file);
                
                $upload          = new Uploads;
                $upload->path    = $fileData->store($this->folder, 'public');
                $upload->type    = $fileData->getClientOriginalExtension();
                $upload->document_name = $fileData->getClientOriginalName();
                $upload->document_file_type = $file;
                $holderSubmission->uploads()->save($upload);
            }
        }

        /* To check all documents uploaded or not */
        $holderSubmission->checkUpdateAllDocUploadedStatus();

        $notification = ['message' => trans('cruds.holder_submissions.title_singular')." ".trans('messages.add_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.holder-submissions.index')->with($notification);
    }

    public function edit(HolderSubmission $holderSubmission)
    {
        abort_if(Gate::denies('holder_submission_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.holder_submissions.edit');
        $status              = $this->status;
        $issuers = Issuer::pluck('name', 'id');
        $receivers = Receiver::pluck('name', 'id');
        $students    = Student::pluck('name','id');
        return view('admin.holder_submissions.edit', compact('holderSubmission','pageTitle','status','issuers','receivers','students'));
    }

    public function update(UpdateRequest $request, HolderSubmission $holderSubmission)
    {
        $holderSubmission->update($request->all());
        // document upload
        $documentFiles = array_keys(config('constant.holder_submission_documents'));
        if(!empty($documentFiles)){
            foreach ($documentFiles as $key => $files) {
                if ($request->hasFile($files)) {
                    $document = $holderSubmission->uploads->where('document_file_type', $files)->first();
                    if (isset($document) && isset($document->id)) {
                        \Storage::disk('public')->delete($document->path);                    
                    }

                    $file = $request->file($files);
                    $path = $file->store($this->folder, 'public');
                    $type = $file->getClientOriginalExtension();
                    $document_name = $file->getClientOriginalName();
                    $holderSubmission->uploads()->updateOrCreate(
                        [
                            'document_file_type' => $files,
                            'uploadsable_id'     => $holderSubmission->id,
                        ],
                        [
                            'path'=> $path,
                            'type'=> $type,
                            'document_name'=> $document_name,
                            'document_file_type'=> $files,
                        ]
                    );
                }
            }
            /* To check all documents uploaded or not */
            $holderSubmission->checkUpdateAllDocUploadedStatus();
        }
        $notification = ['message' => trans('cruds.holder_submissions.title_singular')." ".trans('messages.edit_success_message'),'alert-type' =>  trans('panel.alert-type.success')];
        return redirect()->route('admin.holder-submissions.index')->with($notification);
    }


    public function show(HolderSubmission $holderSubmission)
    {
        abort_if(Gate::denies('holder_submission_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $pageTitle = trans('panel.page_title.holder_submissions.show');
        $status    = $this->status;
        $goToStep  = str_replace('stage_', '', $holderSubmission->current_stage)-1;
        if($goToStep < 0){
            $goToStep = 0;
        }
        return view('admin.holder_submissions.show', compact('holderSubmission','pageTitle','status','goToStep'));
    }

    public function destroy(HolderSubmission $holderSubmission)
    {
        abort_if(Gate::denies('holder_submission_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $holderSubmission->delete();
        return response()->json(['success' => true, 'message' => trans('cruds.holder_submissions.title_singular').' '.trans('messages.delete_success_message')], 200);        
    }

    public function changeStatus(Request $request)
    {
        if ($request->ajax()) {    
            $validator = Validator::make($request->all(), [
                'id' => [
                    'required',
                    'numeric',
                    'exists:holder_submissions,id',
                ],
            ]);

            if (!$validator->passes()) {
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }else{   
                
                $holderSubmission = HolderSubmission::where('id', $request->id)->update(['status' => $request->status]);
                $response = [
                    'status'    => 'true',
                    'message'   => trans('cruds.holder_submissions.title_singular').' '.trans('messages.change_status_success_message'),
                ];
                return response()->json($response);
            }
        }
    }


    public function updateDocument(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'doc_file' => [
                    'mimes:pdf',
                    'max:5000',
                ],
                'file_name' => [
                    'in:'.implode(',',array_keys(config('constant.holder_submission_documents')))
                ],
                'id' => [
                    'exists:holder_submissions,id',
                ]
            ]);

            if($validator->fails()){
                return response()->json(['success'=>false,'errors'=>$validator->getMessageBag()->toArray(),'message'=>'Error Occured!'],400);
            }
        
            $downloadLink = '';
            if ($request->hasFile('doc_file')) {
                $holderSubmission = HolderSubmission::findOrFail($request->id);
                $document = $holderSubmission->uploads->where('document_file_type', $request->file_name)->first();
                if (isset($document) && isset($document->id)) {
                    \Storage::disk('public')->delete($document->path);                    
                }

                $file = $request->file('doc_file');
                $path = $file->store($this->folder, 'public');
                $type = $file->getClientOriginalExtension();
                $document_name = $file->getClientOriginalName();
                $uploadData = $holderSubmission->uploads()->updateOrCreate(
                    [
                        'document_file_type' => $request->file_name,
                        'uploadsable_id'     => $request->id,
                    ],
                    [
                        'path'=> $path,
                        'type'=> $type,
                        'document_name'=> $document_name,
                        'document_file_type'=> $request->file_name,
                    ]
                );
                $document_href = asset('storage/'.$uploadData->path);
                $document_name = $uploadData->document_name;
                $downloadLink = '<a href="'.$document_href.'" download="'.$document_name.'" title="'.$document_name.'" class="document-pdf"> Download </a>';

                /* To check all documents uploaded or not */
                $holderSubmission->checkUpdateAllDocUploadedStatus();
            }
            $success_msg = trans('cruds.holder_submissions.title_singular')." ".trans('messages.edit_success_message');
            return response()->json([
                'success'=>true,
                'message'=>$success_msg,
                'alert-type' =>  trans('panel.alert-type.success'),
                'download_link'=> $downloadLink,
                'all_uploaded'=> $holderSubmission->is_all_document_submitted
            ],200);
        
        }
    }
    
}