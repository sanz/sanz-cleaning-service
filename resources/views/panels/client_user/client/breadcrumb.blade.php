@if(@isset($breadcrumbs))
  <ol class="breadcrumb">
    {{-- this will load breadcrumbs dynamically from controller --}}
    @foreach ($breadcrumbs as $breadcrumb)
      <li class="breadcrumb-item">
        @if(isset($breadcrumb['link']))
          <a href="{{ $breadcrumb['link'] }}">
            @endif
            {{ $breadcrumb['name'] }}
            @if(isset($breadcrumb['link']))
          </a>
        @endif
      </li>
    @endforeach
  </ol>
@endisset
