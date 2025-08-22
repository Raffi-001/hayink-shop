<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    @php
        $id = $getId();
        $isDisabled = $isDisabled();
        $statePath = $getStatePath();
    @endphp

    <ul role="list" class="grid gap-4 xl:grid-cols-6 lg:grid-cols-6">
        @foreach ($getOptions() as $value => $image)
            @php
                $shouldOptionBeDisabled = $isDisabled || $isOptionDisabled($value, $image);
            @endphp
            <li class="">
                <label class="relative">
                    <input
                        @disabled($shouldOptionBeDisabled)
                        id="{{ $id }}-{{ $value }}"
                        name="{{ $id }}"
                        type="checkbox"
                        value="{{ $value }}"
                        wire:loading.attr="disabled"
                        {{ $applyStateBindingModifiers('wire:model') }}="{{ $statePath }}"
                        class="rb-image"
                    />
                    <span class="img-radio-selected"></span>
                    <div class="img-radio">
                        <img src="{{ asset(config('radiobuttonimage.storageName')) }}/{{ $image }}" alt="{{ $value }}" class="focus:bg-primary-500 border cursor-pointer">
                    </div>
                </label>
            </li>
        @endforeach
    </ul>
</x-dynamic-component>

<style>
input[name="{{ $id }}"]:checked + .img-radio-selected::before {
    background-color: rgba(var(--primary-500),var(--tw-bg-opacity));
    position: absolute;
    content: "✓";
    top: 8px;
    left: 14px;
    width: 20px;
    height: 20px;
    z-index: 99999;
}

.rb-image {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}

.img-radio {
    border: 1px solid #dee2e6;
    max-width: 100%;
    border-radius: 5px;
    cursor: pointer;
    display: block;
    height: auto;
    margin: auto;
    padding: 5px;
    position: relative;
    width: 100%;
}

.img-radio:hover img {
    -o-object-position: bottom;
    object-position: bottom;
    border: solid 1px red;
}

.img-radio img {
    -o-object-fit: cover;
    object-fit: cover;
    -o-object-position: top;
    object-position: top;
    transform-origin: 50% 50%;
    transition-duration: .1s;
    transition: all 2s ease;
    width: 100%;
}

.overflow-hidden {
    overflow: hidden;
}
</style>
