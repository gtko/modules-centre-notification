<div class="dropdown relative mr-auto sm:mr-6" x-data="{open:false}">
    <div @click="open=!open" class="dropdown-toggle notification  @if($notifications->count() > 0) notification--bullet @endif cursor-pointer  " role="button" aria-expanded="false">
        <div wire:ignore>
            @icon('bell', 30, 'notification__icon dark:text-gray-300')
        </div>
    </div>

    <div class="-intro-y notification-content pt-2 dropdown-menu" x-bind:class="{'show':open}">
        <div class="notification-content__box dropdown-menu__content box dark:bg-dark-6">
            <div class="notification-content__title">Notifications</div>
            @if($notifications->count() > 0)
            @foreach ($notifications as $notif)
                <div x-data="{hover:false}" x-on:mouseenter="hover=true" x-on:mouseleave="hover=false"  class="cursor-pointer relative flex items-start {{ $notif ? 'mt-5' : '' }}">
                    <div class="w-12 h-12 flex-none image-fit mr-1">
                        <img wire:click="redirectNotif('{{$notif->id}}')" alt="" class="rounded-full" src="{{$notif->data['image']}}">
                    </div>
                    <div class="ml-2 overflow-hidden w-full">
                        <div wire:click="redirectNotif('{{$notif->id}}')" class="flex items-center">
                            <a href="javascript:" class="font-medium truncate mr-5">{{$notif->data['title']}}</a>
                            <div class="text-xs text-gray-500 ml-auto whitespace-nowrap">{{$notif->created_at->format('H:i')}}</div>
                        </div>
                        <div wire:click="redirectNotif('{{$notif->id}}')" class="w-full truncate text-gray-600 mt-0.5">
                            {{$notif->data['content']}}
                        </div>
                        <div x-show='hover' wire:click="markAsRead('{{$notif->id}}')" class="intro-x text-gray-500 mt-0.5 text-xs hover:text-gray-900">Marquer comme lu</div>
                    </div>

                </div>
            @endforeach
            @else
                <div>
                    Vous avez aucune notification
                </div>
            @endif
        </div>
    </div>

</div>
