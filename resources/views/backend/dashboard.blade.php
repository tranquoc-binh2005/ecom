
<!DOCTYPE html>
<html lang="en">
<head>

    @include('backend.components.head')

</head>

<body>

<!-- Begin page -->
<div id="wrapper">

    <!-- Topbar Start -->
    @include('backend.components.topbar')
    <!-- end Topbar -->

    <!-- ========== Left Sidebar Start ========== -->
    @include('backend.components.left-side_bar')
    <!-- Left Sidebar End -->

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="content-page">
        <div class="content">

           @yield('content')

        </div> <!-- content -->

        <!-- Footer Start -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        2019 &copy; Upvex theme by <a href="">Coderthemes</a>
                    </div>
                    <div class="col-md-6">
                        <div class="text-md-right footer-links d-none d-sm-block">
                            <a href="javascript:void(0);">About Us</a>
                            <a href="javascript:void(0);">Help</a>
                            <a href="javascript:void(0);">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end Footer -->

    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->


</div>
<!-- END wrapper -->

<!-- Right Sidebar -->
@include('backend.components.right-side_bar')
<!-- /Right-bar -->

@include('backend.components.script')
</body>
</html>
