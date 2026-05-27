<div class="flex items-center">
    @if($doctor->user)
        <img src="{{ $doctor->user->profile_photo_url }}"
             alt="{{ $doctor->user->name }}"
             class="w-10 h-10 rounded-full object-cover ring-1 ring-gray-200">
    @else
        {{-- Avatar gris por defecto si el usuario fue eliminado o no existe --}}
        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
            <i class="fa-solid fa-user-md"></i>
        </div>
    @endif
</div>
