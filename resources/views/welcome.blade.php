<x-layout>
    <div class="row col-12">
        <div class="col-6">
            <img src="{{ asset('images/dri_local.jpeg') }}" width="100%" height="auto" class="rounded-5">
        </div>
        <div class="col-6">
            <div class="row col-12">
                <div class="col-6">
                    <input type="hidden" value="{{$total_materials}}" id="txt_total_materials">
                    <input type="hidden" value="{{$total_employees}}" id="txt_total_employees">
                    <canvas id="mainChart"></canvas>
                </div>
                <div class="col-6">
                    <input type="hidden" value="{{$total_pc}}" id="txt_total_pc">
                    <input type="hidden" value="{{$total_printers}}" id="txt_total_printer">
                    <canvas id="secondChart"></canvas>
                </div>
            </div>
            <div class="row col-12">
                <div class="col-6">
                    <input type="hidden" value="{{$total_inventory}}" id="txt_total_inventory">
                    <canvas id="invMainChart"></canvas>
                </div>
                <div class="col-6">
                    <input type="hidden" value="{{$total_scanners}}" id="txt_total_scanner">
                    <input type="hidden" value="{{$total_big_printers}}" id="txt_total_big_printer">
                    <input type="hidden" value="{{$total_laptops}}" id="txt_total_laptop">
                    <canvas id="materialTypeChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</x-layout>
