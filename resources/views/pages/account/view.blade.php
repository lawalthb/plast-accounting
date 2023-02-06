<!-- 
expose component model to current view
e.g $arrDataFromDb = $comp_model->fetchData(); //function name
-->
@inject('comp_model', 'App\Models\ComponentsData')
<?php
    //check if current user role is allowed access to the pages
    $can_add = $user->canAccess("users/add");
    $can_edit = $user->canAccess("users/edit");
    $can_view = $user->canAccess("users/view");
    $can_delete = $user->canAccess("users/delete");
    $pageTitle = __('myAccount'); //set dynamic page title
?>
@extends($layout)
@section('title', $pageTitle)
@section('content')
<section class="page" data-page-type="view" data-page-url="{{ url()->full() }}">
    <div  class="" >
        <div class="container">
            <div class="row ">
                <div class="col-md-12 comp-grid " >
                    <?php Html::display_page_errors($errors); ?>
                    <div  class=" page-content" >
                        <?php
                            $counter = 0;
                            if($data){
                            $rec_id = ($data['id'] ? urlencode($data['id']) : null);
                            $counter++;
                        ?>
                        <div class="bg-primary m-2 mb-4">
                            <div class="profile">
                                <div class="avatar">
                                    <?php 
                                        $user_photo = $user->UserPhoto();
                                        if($user_photo){
                                        Html::page_img($user_photo, 100, 100, "small", "large"); 
                                        }
                                    ?>
                                </div>
                                <h1 class="title mt-4"><?php echo $data['username']; ?></h1>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mx-3 mb-3">
                                    <ul class="nav nav-pills flex-column text-left">
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageView" class="nav-link active">
                                                <i class="material-icons">account_box</i> {{ __('accountDetail') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageEdit" class="nav-link">
                                                <i class="material-icons">edit</i> {{ __('editAccount') }}
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a data-bs-toggle="tab" href="#AccountPageChangePassword" class="nav-link">
                                                <i class="material-icons">lock</i> {{ __('changePassword') }}
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="mb-3">
                                    <div class="tab-content">
                                        <div class="tab-pane show active fade" id="AccountPageView" role="tabpanel">
                                            <div class="page-data">
                                                <!--PageComponentStart-->
                                                <div class="mb-3 row row gutter-lg">
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('id') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['id'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('firstname') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['firstname'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('lastname') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['lastname'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('email') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['email'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('roleId') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['role_id'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('phone') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['phone'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('userType') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['user_type'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('dateJoin') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['date_join'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('isActive') }}</small>
                                                                    <div class="fw-bold">
                                                                        <?php echo  $data['is_active'] ; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class=" col-12 col-md-4">
                                                        <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                            <div class="row align-items-center">
                                                                <div class="col">
                                                                    <small class="text-muted">{{ __('companyId') }}</small>
                                                                    <div class="fw-bold">
                                                                        <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("companies/view/$data[company_id]?subpage=1") ?>">
                                                                        <i class="material-icons">visibility</i> <?php echo "Companies Detail" ?>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-12 col-md-4">
                                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <small class="text-muted">{{ __('username') }}</small>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['username'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-12 col-md-4">
                                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <small class="text-muted">{{ __('emailVerifiedAt') }}</small>
                                                                <div class="fw-bold">
                                                                    <?php echo  $data['email_verified_at'] ; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-12 col-md-4">
                                                    <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                        <div class="row align-items-center">
                                                            <div class="col">
                                                                <small class="text-muted">{{ __('userRoleId') }}</small>
                                                                <div class="fw-bold">
                                                                    <a size="sm" class="btn btn-sm btn btn-secondary page-modal" href="<?php print_link("roles/view/$data[user_role_id]?subpage=1") ?>">
                                                                    <i class="material-icons">visibility</i> <?php echo "Roles Detail" ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('dateCreated') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['date_created'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class=" col-12 col-md-4">
                                                <div class="bg-light mb-3 card-1 p-2 border rounded">
                                                    <div class="row align-items-center">
                                                        <div class="col">
                                                            <small class="text-muted">{{ __('dateUpdated') }}</small>
                                                            <div class="fw-bold">
                                                                <?php echo  $data['date_updated'] ; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--PageComponentEnd-->
                                        <div class="d-flex gap-1 justify-content-start">
                                            <?php if($can_edit){ ?>
                                            <a class="btn btn-sm btn-success has-tooltip "   title="{{ __('edit') }}" href="<?php print_link("users/edit/$rec_id"); ?>" >
                                            <i class="material-icons">edit</i> {{ __('edit') }}
                                        </a>
                                        <?php } ?>
                                        <?php if($can_delete){ ?>
                                        <a class="btn btn-sm btn-danger has-tooltip record-delete-btn" data-prompt-msg="{{ __('promptDeleteRecord') }}" data-display-style="modal" title="{{ __('delete') }}" href="<?php print_link("users/delete/$rec_id?redirect=users"); ?>" >
                                        <i class="material-icons">delete_sweep</i> {{ __('delete') }}
                                    </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="AccountPageEdit" role="tabpanel">
                            <div class=" reset-grids">
                                <x-sub-page url="{{ url('account/edit') }}"></x-sub-page>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="AccountPageChangePassword" role="tabpanel">
                            <div class=" reset-grids">
                                @include("pages.account.changepassword")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            }
            else{
        ?>
        <!-- Empty Record Message -->
        <div class="text-muted p-3">
            <i class="material-icons">block</i> {{ __('noRecordFound') }}
        </div>
        <?php
            }
        ?>
    </div>
</div>
</div>
</div>
</div>
</section>
@endsection
<!-- Page custom css -->
@section('pagecss')
<style>
<!--custom page css--><!--pagecss-->
</style>
@endsection
<!-- Page custom js -->
@section('pagejs')
<script>
    <!--pageautofill--><!--custom page js--><!--pagejs-->
</script>
@endsection
