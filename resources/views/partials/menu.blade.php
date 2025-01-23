<nav id="pcoded-navbar" class="pcoded-navbar">
    <div class="navbar-wrapper">
        <div class="navbar-brand header-logo b-brand">   
            <div class="menu-logo-small">
                <img src="{{ asset('assets/admin/images/sm_logo_img.png') }}" alt="Small Logo Here">
            </div>         
            <div class="menu-logo">
                <img src="{{ asset('assets/admin/images/logo_full_img.png') }}" alt="Logo Here">
            </div>
            <!-- <span class="b-title">{{ config('app.name') }}</span> -->
            <a class="mobile-menu" id="mobile-collapse" href="javascript:void(0)"><span></span></a>
        </div>

        <div class="navbar-content scroll-div">
            @auth
                <ul class="nav pcoded-inner-navbar">            
                    <li data-username="admin_dashboard" class="nav-item {{ request()->is('admin') ? 'active' : '' }}">
                      <a href="{{ route('admin.home') }}" class="nav-link">
                          <span class="pcoded-micon">
                              <i class="feather icon-home"></i>
                          </span>
                          <span class="pcoded-mtext">Countries</span>
                      </a>
                    </li>
                    @can('user_management_access')
                        <li data-username="user_management_access" class="nav-item pcoded-hasmenu {{ request()->is('admin/users*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/roles*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/permissions*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="fa-solid fa-users-between-lines"></i>
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.userManagement.title') }}</span>
                            </a>
                            
                            <ul class="pcoded-submenu">            
                                @can('user_access')
                                    <li data-username="users" class="nav-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.users.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-users"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.user.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('role_access')
                                    <li data-username="role" class="nav-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.roles.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-list"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.role.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                                @can('permission_access')
                                    <li data-username="permission" class="nav-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.permissions.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-list"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.permission.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan


                    @can('issuer_management_access')
                        <li data-username="issuer_management_access" class="nav-item pcoded-hasmenu {{ request()->is('admin/issuers*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/issuer/degrees*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/issuer/curriculum-details*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/issuer/curriculums*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/issuer/billing-definitions*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="fa-solid fa-user-graduate"></i>
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.issuerManagement.title') }}</span>
                            </a>
                            
                            <ul class="pcoded-submenu">            
                                @can('issuer_access')
                                    <li data-username="issuer" class="nav-item {{ request()->is('admin/issuers') || request()->is('admin/issuers*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.issuers.index') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa-solid fa-user-tie"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.issuer.title') }}</span>
                                    </a>
                                    </li>
                                @endcan
                                
                                @can('degrees_access')
                                    <li data-username="issuer" class="nav-item {{ request()->is('admin/issuer/degrees') || request()->is('admin/issuer/degrees*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.degrees.index','issuer') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.degrees.title') }}</span>
                                    </a>
                                    </li>
                                @endcan

                                @can('curriculums_access')
                                    <li data-username="issuer" class="nav-item {{ request()->is('admin/issuer/curriculums') || request()->is('admin/issuer/curriculums*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.curriculums.index','issuer') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa fa-book-open"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.curriculums.title') }}</span>
                                    </a>
                                    </li>
                                @endcan

                                @can('curriculum_detail_access')
                                    <li data-username="issuer" class="nav-item {{ request()->is('admin/issuer/curriculum-details') || request()->is('admin/issuer/curriculum-details*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.curriculum-details.index','issuer') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa-solid fa-book-open-reader"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.curriculum_details.title') }}</span>
                                    </a>
                                    </li>
                                @endcan

                                @can('billing_definitions_access')
                                    <li data-username="issuer-billing" class="nav-item {{ request()->is('admin/issuer/billing-definitions') || request()->is('admin/issuer/billing-definitions*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.billing-definitions.index','issuer') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa-solid fa-file-invoice-dollar"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.billing_definitions.title') }}</span>
                                    </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('receiver_management_access')
                        <li data-username="receiver_management_access" class="nav-item pcoded-hasmenu {{ request()->is('admin/receivers*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/receiver/degrees*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/receiver/curriculums*') ? 'active pcoded-trigger' : '' }}  {{ request()->is('admin/receiver/curriculum-details*') ? 'active pcoded-trigger' : '' }} {{ request()->is('admin/receiver/billing-definitions*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="fa-solid fa-users-rectangle"></i>                                   
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.receiverManagement.title') }}</span>
                            </a>
                            
                            <ul class="pcoded-submenu">            
                                @can('receiver_access')
                                    <li data-username="receiver" class="nav-item {{ request()->is('admin/receivers') || request()->is('admin/receivers*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.receivers.index') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="feather icon-user-plus"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.receiver.title') }}</span>
                                    </a>
                                    </li>
                                @endcan
                                
                                @can('degrees_access')
                                    <li data-username="receiver-degrees" class="nav-item {{ request()->is('admin/receiver/degrees') || request()->is('admin/receiver/degrees*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.degrees.index','receiver') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa-solid fa-graduation-cap"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.degrees.title') }}</span>
                                    </a>
                                    </li>
                                @endcan

                                @can('curriculums_access')
                                    <li data-username="receiver-curriculums" class="nav-item {{ request()->is('admin/receiver/curriculums') || request()->is('admin/receiver/curriculums*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.curriculums.index','receiver') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa fa-book-open"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.curriculums.title') }}</span>
                                    </a>
                                    </li>
                                @endcan

                                @can('curriculum_detail_access')
                                    <li data-username="receiver-curriculum-details" class="nav-item {{ request()->is('admin/receiver/curriculum-details') || request()->is('admin/receiver/curriculum-details*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.curriculum-details.index','receiver') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa-solid fa-book-open-reader"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.curriculum_details.title') }}</span>
                                    </a>
                                    </li>
                                @endcan

                                @can('billing_definitions_access')
                                    <li data-username="receiver-billing" class="nav-item {{ request()->is('admin/receiver/billing-definitions') || request()->is('admin/receiver/billing-definitions*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.billing-definitions.index','receiver') }}" class="nav-link">
                                        <span class="pcoded-micon">
                                            <i class="fa-solid fa-file-invoice-dollar"></i>
                                        </span>
                                        <span class="pcoded-mtext">{{ trans('cruds.billing_definitions.title') }}</span>
                                    </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>
                    @endcan

                    @can('student_access')
                        <li data-username="student" class="nav-item {{ request()->is('admin/students') || request()->is('admin/students/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.students.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="fa-solid fa-user-tie"></i>
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.students.title') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('evaluation_management_access')
                        <li data-username="evaluation-management" class="nav-item pcoded-hasmenu {{ request()->is('admin/evaluation-templates*') || request()->is('admin/evaluation-template-mappings*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-bars-progress"></i></span><span class="pcoded-mtext">{{ trans('cruds.evaluationManagement.title') }}</span></a>
                            
                            <ul class="pcoded-submenu"> 
                                @can('evaluation_templates_access')
                                    <li data-username="evaluation-templates" class="nav-item {{ request()->is('admin/evaluation-templates') || request()->is('admin/evaluation-templates/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.evaluation-templates.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-book"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.evaluation_templates.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('evaluation_template_mapping_access')
                                    <li data-username="evaluation-template-mapping" class="nav-item {{ request()->is('admin/evaluation-template-mappings') || request()->is('admin/evaluation-template-mappings/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.evaluation-template-mappings.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-address-card"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.evaluation_template_mapping.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

                    @can('holder_submission_access')
                        <li data-username="holder-submissions" class="nav-item {{ request()->is('admin/holder-submissions') || request()->is('admin/holder-submissions/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.holder-submissions.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="fa-solid fa-chalkboard-user"></i>
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.holder_submissions.title') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('processing_submission_access')
                        <li data-username="processing-submissions" class="nav-item {{ request()->is('admin/processing-submissions') || request()->is('admin/processing-submissions/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.processing-submissions.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="fa-solid fa-arrow-up-wide-short"></i>
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.processing_submissions.title') }}</span>
                            </a>
                        </li>
                    @endcan

                    @can('submission_stage_management_access')
                        {{--<li data-username="submission-stage-management" class="nav-item pcoded-hasmenu {{ request()->is('admin/submission-processing/stage1/bill-verify-payments*') ? 'active pcoded-trigger' : '' }}">
                            <a href="javascript: void(0)" class="nav-link"><span class="pcoded-micon"><i class="fa-solid fa-bars-staggered"></i></span><span class="pcoded-mtext">{{ trans('cruds.submissionStageManagement.title') }}</span></a>
                            
                            <ul class="pcoded-submenu"> 
                                @can('bill_verify_payment_access')
                                    <li data-username="bill-and-verify-payment" class="nav-item {{ request()->is('admin/submission-processing/stage1/bill-verify-payments') || request()->is('admin/submission-processing/stage1/bill-verify-payments/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.submissionProcessing.stage1.bill-verify-payments.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-money-bill-1"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.bill_verify_payments.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('request_verification_access')
                                    <li data-username="request-verification-access" class="nav-item {{ request()->is('admin/submission-processing/stage2/request-verification-access') || request()->is('admin/submission-processing/stage2/request-verification-access/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.submissionProcessing.stage2.request-verification-access.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-money-bill-1"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.request_verification.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('extract_transcript_access')
                                    <li data-username="extract-transcripts" class="nav-item {{ request()->is('admin/submission-processing/stage3/extract-transcripts') || request()->is('admin/submission-processing/stage3/extract-transcripts/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.submissionProcessing.stage3.extract-transcripts.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-money-bill-1"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.extract_transcript.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('update_verification_access')
                                    <li data-username="request-verification" class="nav-item {{ request()->is('javascript:void(0);') || request()->is('javascript:void(0);') ? 'active' : '' }}">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-check-double"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.update_verification.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('perform_evaluation_access')
                                    <li data-username="request-verification" class="nav-item {{ request()->is('javascript:void(0);') || request()->is('javascript:void(0);') ? 'active' : '' }}">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-dna"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.perform_evaluation.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('prepare_report_access')
                                    <li data-username="request-verification" class="nav-item {{ request()->is('javascript:void(0);') || request()->is('javascript:void(0);') ? 'active' : '' }}">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-list"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.prepare_report.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('validate_report_access')
                                    <li data-username="request-verification" class="nav-item {{ request()->is('javascript:void(0);') || request()->is('javascript:void(0);') ? 'active' : '' }}">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-align-center"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.validate_report.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('deliver_report_access')
                                    <li data-username="request-verification" class="nav-item {{ request()->is('javascript:void(0);') || request()->is('javascript:void(0);') ? 'active' : '' }}">
                                        <a href="javascript:void(0);" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="fa-solid fa-address-card"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.deliver_report.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                            </ul>
                        </li>--}}
                    @endcan
                    

                    @can('master_access')
                        <li data-username="master_access" class="nav-item pcoded-hasmenu {{ request()->is('admin/levels*') || request()->is('admin/countries*') || request()->is('admin/accreditation-bodies*') || request()->is('admin/contry*') ? 'active pcoded-trigger' : '' }}">
                            <a href="#!" class="nav-link">
                                <span class="pcoded-micon"><i class="feather icon-cpu"></i></span>
                                <span class="pcoded-mtext">{{ trans('cruds.masterManagement.title') }}</span>
                            </a>
                            
                            <ul class="pcoded-submenu">
                                @can('level_master_access')
                                    <li data-username="level_master" class="nav-item {{ request()->is('admin/levels') || request()->is('admin/levels/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.levels.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-server"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.levels.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('country_access')
                                    <li data-username="country" class="nav-item {{ request()->is('admin/countries') || request()->is('admin/countries/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.countries.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-map-pin"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.country.title') }}</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('accreditation_body_access')
                                    <li data-username="accreditation_body" class="nav-item {{ request()->is('admin/accreditation-bodies') || request()->is('admin/accreditation-bodies/*') ? 'active' : '' }}">
                                        <a href="{{ route('admin.accreditation-bodies.index') }}" class="nav-link">
                                            <span class="pcoded-micon">
                                                <i class="feather icon-list"></i>
                                            </span>
                                            <span class="pcoded-mtext">{{ trans('cruds.accreditation_bodies.title') }}</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        <li data-username="category" class="nav-item {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active' : '' }}">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link">
                                <span class="pcoded-micon">
                                    <i class="feather icon-layers"></i> <!-- Choose an appropriate icon -->
                                </span>
                                <span class="pcoded-mtext">{{ trans('cruds.category.title') }}</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            @endauth
        </div>
    </div>
</nav>
    <!-- [ navigation menu ] end