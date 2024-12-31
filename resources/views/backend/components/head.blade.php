<base href="{{ config('app.url') }}">
<meta charset="utf-8">
<title>{{ $title ?? 'qBEcommerce | Trang quản trị hệ thống' }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description">
<meta content="Coderthemes" name="author">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--Fake token-->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- App favicon -->
<link rel="shortcut icon" href="templates\admin\assets\images\favicon.ico">

<!-- plugin css -->
<link href="templates\admin\assets\libs\jquery-vectormap\jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css">

<!-- App css -->
<link href="templates\admin\assets\css\bootstrap.min.css" rel="stylesheet" type="text/css">
<link href="templates\admin\assets\css\icons.min.css" rel="stylesheet" type="text/css">
<link href="templates\admin\assets\css\app.min.css" rel="stylesheet" type="text/css">
<link href="templates\admin\assets\css\customize.css" rel="stylesheet" type="text/css">
<!-- Switchery css -->
<link href="templates\admin\assets\libs\switchery\switchery.min.css" rel="stylesheet" type="text/css">
<!-- select2 css -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- ckeditor5 css -->
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/44.0.0/ckeditor5.css" />

<script>
    let BASE_URL = "{{config('app.url')}}";
    let SUFFIX = ".html"
</script>
