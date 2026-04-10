    {{-- Vendor Scripts --}}
        <script src="{{ asset(mix('vendors/js/vendors.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/ui/prism.min.js')) }}"></script>

        @yield('vendor-script')
        <script src="{{ asset('js/scripts/HoldOn/HoldOn.min.js') }}"></script>
        <script src="{{ asset('js/scripts/HoldOn/runHoldOn.js') }}"></script>
        
        {{-- Theme Scripts --}}
        <script src="{{ asset(mix('js/core/app-menu.js')) }}"></script>
        <script src="{{ asset(mix('js/core/app.js')) }}"></script>
        <script src="{{ asset(mix('js/scripts/components.js')) }}"></script>
        <script src="{{ asset('js/custom_script.js') }}"></script>

@if($configData['blankPage'] == false)
        <script src="{{ asset(mix('js/scripts/footer.js')) }}"></script>
@endif
        {{-- page script --}}
        @yield('page-script')
