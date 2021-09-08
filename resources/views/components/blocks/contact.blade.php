<div class="my-10 mx-4">
  <div class="max-w-5xl mx-auto text-gray-700">
    <h2 class="text-4xl mb-6">{{ $block->heading }}</h2>

    <p class="text-base">
      {!! nl2br($block->body) !!}
    </p>

    @if( $block->actions->count() > 0 )
      <div class="mt-6 space-x-6">
        @foreach( $block->actions as $action )
          <a href="{{ $action->link() }}" class="py-2 px-4 rounded-lg bg-indigo-600 text-white">{{ $action->action }}</a>
        @endforeach
      </div>
    @endif

    <div class="bg-gray-100 mt-6 border border-gray-400 rounded-xl overflow-hidden">
      @if (session('status'))
        <div class="bg-green-100 border-b border-green-400 p-4 text-green-600 font-bold">{{ session('status') }}</div>
      @endif

      <form action="{{ route('form.contact', $block->page) }}" method="POST">
        @csrf

        <div class="space-y-4 p-4">
          <div>
            <label for="contact_name" class="block mb-2 text-sm uppercase">{{ __('Name') }}</label>
            <input type="text" name="name" id="contact_name" value="{{ old('name', (Auth::check() ? Auth::user()->name : '')) }}" class="w-full rounded-lg border border-gray-400 focus:border-indigo-600">
            @error('name')
              <p class="mt-2 text-sm text-red-600" id="name-error">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="contact_email" class="block mb-2 text-sm uppercase">{{ __('Email address') }}</label>
            <input type="text" name="email" id="contact_email" value="{{ old('email', (Auth::check() ? Auth::user()->email : '')) }}" class="w-full rounded-lg border border-gray-400 focus:border-indigo-600">
            @error('email')
              <p class="mt-2 text-sm text-red-600" id="name-error">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label for="contact_message" class="block mb-2 text-sm uppercase">{{ __('Message') }}</label>
            <textarea name="message" id="contact_message" rows="5" cols="80" class="w-full rounded-lg border border-gray-400 focus:border-indigo-600">{{ old('message') }}</textarea>
            @error('message')
              <p class="mt-2 text-sm text-red-600" id="name-error">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <button type="submit" class="rounded-lg py-2 px-4 text-white bg-indigo-600">{{ __('Send') }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
