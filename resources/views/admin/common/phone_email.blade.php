<div class="row">
    <div class="col-xs-6">
        <label for="name">Телефоны</label>
        <input
                type="text"
                name="phone"
                class="form-control"
                id="phone"
                value="{{$data->phone}}"
                placeholder="Телефоны">
    </div>
    <div class="col-xs-6">
        <label for="alias">Email </label>
        <input
                type="email"
                name="email"
                class="form-control"
                id="email"
                value="{{$data->email}}"
                placeholder="Email">
    </div>
</div>