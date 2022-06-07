<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>Laravel </title>
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>
<div class="container">
<div class="content">
<div class="row">
<div class="col-md-12">
<div class="card card-user">
<div class="card-header">
<h5 class="card-title">Contact Us</h5>
</div>
<div class="card-body">
@if(Session::has('success'))
<div class="alert alert-success">
{{ Session::get('success') }}
</div>
@endif

<form action=" " method="post"   enctype="multipart/form-data">
{{csrf_field()}}
<div class="row">
<div class="col-md-12">
<div class="form-group">
<label> Name </label>
<input type="text" class="form-control " placeholder="Name" name="name" required>

</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label> Email </label>
<input type="text" class="form-control " placeholder="Email" name="email" required>

</div>
</div> 
<div class="col-md-12">
<div class="form-group">
<label> Phone Number </label>
<input type="text" class="form-control " placeholder="Phone Number" name="phone_number" required>

</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label> Subject </label>
<input type="text" class="form-control " placeholder="Subject" name="subject" required>

</div>
</div>
<div class="col-md-12">
<div class="form-group">
<label> Message </label>
<textarea class="form-control " placeholder="Message" name="message" required></textarea>

<span class="invalid-feedback" role="alert">

</div>
</div>



</div>

<div class="col-md-12">
<div class="form-group">
<label>upload resume</label>
<input type="file" name="resume" accept=".doc,.docx,.pdf" required>
</div>
</div>
<div class="row">
<div class="update ml-auto mr-auto">
<button type="submit" class="btn btn-primary btn-round">Send</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>