<!-- BEGIN: Vendor JS-->
<script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
<!-- BEGIN Vendor JS-->
<!-- BEGIN: Page Vendor JS-->
<script src="{{asset(mix('vendors/js/ui/jquery.sticky.js'))}}"></script>
@yield('vendor-script')
@stack('vendor-script')
<!-- END: Page Vendor JS-->
<!-- BEGIN: Theme JS-->
<script src="https://unpkg.com/dayjs@1.11.1/dayjs.min.js"></script>
<script src="https://unpkg.com/dayjs@1.11.1/plugin/utc.js"></script>
<script src="https://unpkg.com/dayjs@1.11.1/plugin/timezone.js"></script>
<script>dayjs.extend(window.dayjs_plugin_utc)</script>
<script>dayjs.extend(window.dayjs_plugin_timezone)</script>
<script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
<script src="{{ asset(mix('js/core/app.js')) }}"></script>

<!-- custome scripts file for user -->
<script src="{{ asset(mix('js/core/scripts.js')) }}"></script>

@if($configData['blankPage'] === false)
<script src="{{ asset(mix('js/scripts/customizer.js')) }}"></script>
@endif
<!-- END: Theme JS-->
<!-- BEGIN: Page JS-->
@yield('page-script')
@stack('page-script')
<!-- END: Page JS-->

@stack('component-script')
