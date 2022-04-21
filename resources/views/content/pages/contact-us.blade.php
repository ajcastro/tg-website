{{-- BEGIN: Customizer --}}
<div class="customizer d-none d-md-block">

  <a class="customizer-toggle d-flex align-items-center justify-content-center" href="javascript:void(0);">
    <i data-feather='phone-call'></i>
  </a>

  <div class="customizer-content">
    <!-- Customizer header -->
    <div class="customizer-header px-2 pt-1 pb-0 position-relative">
      <h4 class="mb-0">Contact Us</h4>
      {{-- <p class="m-0">Customize & Preview in Real Time</p> --}}
      <a class="customizer-close" href="javascript:void(0);"><i data-feather="x"></i></a>
    </div>

    <hr style="margin-bottom: 0px;" />

    <!-- Contact Us Items -->
    <div class="contact-us-items p-2">
      <div class="list-group">
        @foreach (\App\Models\ContactSetting::onlyDisplayable()->forCurrentWebsite()->get() as $contact)
        <a href="{{ $contact->value }}" class="list-group-item list-group-item-action" target="_blank"> {{ $contact->title }} </a>
        @endforeach
      </div>
    </div>
  </div>
</div>
{{-- End: Customizer --}}
