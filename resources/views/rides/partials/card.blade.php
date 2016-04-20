<div style="background-image: url({{ $ride->driver->avatar }})" class="card__image"></div>
<h2 class="card__title">{{ $ride->title }}</h2><span class="card__subtitle">{{ $ride->departure_city }}</span>
<p class="card__text">
    <small>from</small> {{ $ride->departure_city }} <small>to</small> {{ $ride->arrival_city }}
    <br>
    <small>at</small> {{ $ride->departure_time }} <small>on</small> {{ $ride->departure_date }}
</p>
<div class="card__action-bar">
    <a class="card__button"><i class="fa fa-heart fa-fw"></i> SAVE FOR LATER</a>
    <a class="card__button">LEARN MORE</a>
</div>