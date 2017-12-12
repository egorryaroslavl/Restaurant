<div class="row">
    <div class="col-xs-6">
        <label for="name">Email для заявок</label>
        <input
                type="text"
                name="order_email"
                class="form-control"
                id="order_email"
                value="{{$data->order_email}}"
                placeholder="Email для заявок">
    </div>
    <div class="col-xs-6">
        <label for="alias">Skype </label>
        <input
                type="text"
                name="skype"
                class="form-control"
                id="skype"
                value="{{$data->skype}}"
                placeholder="Skype">
    </div>
</div>