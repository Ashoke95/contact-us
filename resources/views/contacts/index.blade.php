@extends('contacts.layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Student Record</div>
                    <div class="card-body">
                        <a href="{{ url('/contact/create') }}" class="btn btn-success btn-sm">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <a href="{{url('contact-us')}}"  class="btn btn-primary btn-sm">   <i class="fa fa-plus" aria-hidden="true"></i> Contact Us



                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Serial No</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Photo</th>
                                        <th>Mobile No</th>
                                         
                                         <th>State</th>
                                         <th>District</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($contacts as $item)
                                    <tr>
                                        <td>{{ $item->id}}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->address }}</td>
                                        <td><a href="http://localhost/practicelaravel/contact-us/storage/images/{{$item['image']}}"
                     ><img src="http://localhost/practicelaravel/contact-us/storage/images/{{$item['image']}}" height="100px" width="100px" ></a></td>
                                        <td>{{ $item->mobile }}</td>
                                        <td>{{ $item->state }}</td>
                                        <td>{{ $item->district }}</td>
                                        
                                       <td>
                                            <a href="{{ url( route('editstudent',$item['id']) ) }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update</button></a>


                                            <form   <a onclick="return confirm('Are you Sure to delete ?')" action="{{ url('deletestudent',$item['id']) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Contact" ><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button></a>
                                             </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection