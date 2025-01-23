<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered table-responsive-md table-responsive-sm">
            <tbody>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.student_id') }}
                    </th>
                    <td>
                        {{ $holderSubmission->students->name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.submission_date') }}
                    </th>
                    <td>
                        {{ $holderSubmission->submission_date ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.submission_ref') }}
                    </th>
                    <td>
                        {{ $holderSubmission->submission_ref ?? '' }}
                    </td>
                </tr>                
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.issuer_id') }}
                    </th>
                    <td>
                        {{ $holderSubmission->issuer->name ?? '' }}
                        <span class="badge badge-pill badge-primary">{{ $holderSubmission->issuerDegree->qualification ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.receiver_id') }}
                    </th>
                    <td>
                        {{ $holderSubmission->receiver->name ?? '' }}
                        <span class="badge badge-pill badge-info">{{ $holderSubmission->receiverDegree->qualification ?? '' }}</span>
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.receiver_reference') }}
                    </th>
                    <td>
                        {{ $holderSubmission->receiver_reference ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.school_name') }}
                    </th>
                    <td>
                        {{ $holderSubmission->school_name ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.start_year') }}
                    </th>
                    <td>
                        {{ $holderSubmission->start_year ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.end_year') }}
                    </th>
                    <td>
                        {{ $holderSubmission->end_year ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.fees_to_pay') }}
                    </th>
                    <td>
                        {{ $holderSubmission->fees_to_pay ?? '' }}
                    </td>
                </tr>
                <tr>
                    <th>
                        {{ trans('cruds.holder_submissions.fields.status') }}
                    </th>
                    <td>
                        {{ ucwords($holderSubmission->status ?? '') }}
                    </td>
                </tr>
            </tbody>
        </table>             
    </div> 
</div>

<div class="row my-3">
    <div class="col-md-12">
        <h4>{{ trans('cruds.holder_submissions.fields.documents') }}</h4>
    </div>  
    <div class="col-md-12">
        @php
            $file_keys = config('constant.holder_submission_documents');
            $filesData = [];
            $i =0;
            $filesDataLabel = '';
            $filesDataStatus = '';
            $filesDataDownload = '';
            foreach($file_keys as $key => $file){
                $filesLabel = '<th>'.$file.'</th>';
                $filesStatus = '<td class="download_status_'.$key.'">No</td>';
                $filesDownload = '<td class="file_'.$key.'"><div class="download-choose">
                    <span class="download-text">Upload</span><input type="file" name="'.$key.'" class="uploadify" data-filename="'.$key.'">
                </div></td>';

                $uploadData = $holderSubmission->uploads()->where('document_file_type',$key)->first();
                if($uploadData){
                    if(isset($uploadData) && isset($uploadData->path) && Storage::disk('public')->exists($uploadData->path)){
                        $document_href = asset('storage/'.$uploadData->path);
                        $document_name = $uploadData->document_name;
                        $filesStatus = '<td>Yes</td>';
                        $filesDownload = '<td><a href="'.$document_href.'" download="'.$document_name.'" title="'.$document_name.'" class="document-pdf"> Download </a></td>';
                    }
                }
                $filesDataLabel .= $filesLabel;
                $filesDataStatus .= $filesStatus;
                $filesDataDownload .= $filesDownload;
                $i++;
            }
            $filesData['label'] = $filesDataLabel;
            $filesData['status'] = $filesDataStatus;
            $filesData['download'] = $filesDataDownload;
        @endphp
        <table class="table table-bordered table-responsive-md table-responsive-sm">
            <thead>
                <tr>
                   {!! $filesData['label'] !!}
                </tr>
            </thead>
            <tbody>
                <tr>{!! $filesData['status'] !!}</tr>
                <tr>{!! $filesData['download'] !!}</tr>
            </tbody>
        </table>
    </div>                    
</div>

@section('scripts')
@parent
<script type="text/javascript">
    $(document).ready( function(){
        $('.uploadify').change(function() { 
            $('#pageloader').css('display', 'flex');
            var file_data = $(this).prop('files')[0];   
            if(file_data != ''){
                var file_name = $(this).data('filename');
                var form_data = new FormData();                  
                form_data.append('doc_file',file_data);
                form_data.append('file_name',file_name);
                form_data.append('id',{{$holderSubmission->id}});
                console.log(form_data);                             
                $.ajax({
                    url: "{{ route('admin.holderSubmissions.updateDocument') }}", 
                    type: 'POST',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'text json',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: form_data,                         
                    success: function(response){
                      if (response.success == true){
                        $(".file_"+file_name).html(response.download_link);
						  $(".download_status_"+file_name).html("Yes");
						  
                      }
                      $('#finishBtn').addClass('disabled-btn');
                      if(response.all_uploaded){
                        $('#finishBtn').removeClass('disabled-btn');
                      }
                      $('#pageloader').css('display', 'none');
                    },
                    error: function(response) {
                        console.log(response.responseJSON);
                        $.each(response.responseJSON.errors, function(i, message) {
                            toastr.error(message);
                        });
                        $('#pageloader').css('display', 'none');
                    }
                });
            }
        });
    });
</script>
@endsection
    