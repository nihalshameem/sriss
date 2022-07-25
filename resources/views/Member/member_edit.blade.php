@extends('layouts.app')

@section('content')
    <div class="content-wrapper">

        <section class="content" style="padding-top:15px">
            <div class="container-fluid">

                <div class="col-12">
                    <div class="row mb-2">
                        <div class="col-sm-2">
                            <a href="/home" class="btn btn-back"
                                style="float:left;border-radius: 3px;background-color: aqua;margin-top: 0px;margin-left: -19px;"><i
                                    class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp;</a>
                        </div>
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-4">
                            <h3 class="title-head">Edit Member</h3>
                        </div>
                        <div class="col-sm-3">
                        </div>

                    </div>
                </div><br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            @if (Session::has('success'))
                                <div class="alert alert-success alert-block"
                                    style="border-color: #8ac38b;color: #388E3C;background-color: #cde0c4;">
                                    <a class="close" data-dismiss="alert" href="#">×</a>
                                    <p style="font-weight:600">{{ Session::get('success') }}</p>
                                </div>
                            @endif

                            {{-- edit form --}}
                            <form role="form" method="post" class="col-md-12 was-validated"
                                action="{{ route('save.singleGroupMember') }}" class="CreateGroup"
                                style="margin: 0 auto;padding-top: 10px;padding-bottom:20px">
                                <div class="row">

                                    @csrf
                                    <div class="col-md-6 form-group">
                                        <label for="member_id">Member ID</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $member->Member_Id }}" id="member_id" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="first_name">Full Name</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $member->First_Name . ' ' . $member->Last_Name }}" id="first_name"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="email">Email</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $member->Email_Id }}" id="email" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="mobile_number">Mobile Number</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $member->Mobile_No }}" id="mobile_number" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="pincode">Pincode</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $member->Pincode }}" id="pincode" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="address">Address</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $member->Address1 . ',' . $member->Address2 }}" id="address"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="category">Category</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $category->Category }}" id="category" readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label for="status">Status</label><br>
                                        <input type="text" class="form-control" maxlength="200"
                                            value="{{ $member->Member_Active_Flag == 'Y' ? 'Yes' : 'No' }}" id="status"
                                            readonly>
                                    </div>
                                    <div class="col-md-6 form-group">
                                        <label>Group Name</label><br>
                                        <select name="group_multi_id1[]" id="group_name1" multiple="multiple"
                                            required="">
                                            <option value="">Group Name</option>
                                            @foreach ($memberGroups as $memberGroup)
                                                <option value="{{ $memberGroup->Group_id }}">
                                                    {{ $memberGroup->Group_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <input name="member_id" value="{{ $member->id }}" type="hidden" />

                                    </div>
                                    <div class="col-md-6 form-group">

                                        <button style="margin-top: 32px" type="submit"
                                            class="btn btn-primary">Submit</button>

                                    </div>

                                </div>
                            </form>

                        </div>

                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
    <script type="text/javascript">
        let selected = [
            @foreach ($member->groups as $item)
                {{ $item->Group_id }},
            @endforeach
        ];
        console.log(selected)
        document.addEventListener('DOMContentLoaded', function() {
            $.each(selected, function(key, val) {
                $('#group_name1').multiselect('select', val)
            });
        }, false);
    </script>
@endsection
