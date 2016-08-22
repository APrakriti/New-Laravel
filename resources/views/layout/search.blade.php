<?php
$allActivities = \App\Models\Activity::where('is_active', 1)->lists('heading', 'id');
$allDestinations = \App\Models\Destination::where('is_active', 1)->lists('heading', 'id');

?>


<div class="container inner_search_wrap">
    <form action="{{ route('search') }}" id="searchForm" method="get">
        <div class="row">

            <div class="col l3 m6 s6">

                <select class="browser-default  bdr0" name="destination_id">
                    <option value="">
                        Select Destination
                    </option>
                    @foreach($allDestinations as $id=>$heading)
                        <option value="{{ $id }}"
                                @if(Input::get('destination_id')==$id ) selected="selected" @endif>
                            {{ $heading }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col l3 m6 s6">
                <select class="browser-default  bdr0" name="activity_id">
                    <option value="">
                        Select Activity
                    </option>
                    @foreach($allActivities as $id=>$heading)
                        <option value="{{ $id }}"
                                @if(Input::get('activity_id')==$id ) selected="selected" @endif>
                            {{ $heading }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col l2 m6 s6">
                <select class="browser-default  bdr0" name="duration">
                    <option value="">
                        Select Duration
                    </option>
                    <option value="1-5" @if(Input::get('duration')=='1-5' ) selected="selected" @endif>
                        1-5 Days
                    </option>
                    <option value="6-10" @if(Input::get('duration')=='6-10' ) selected="selected" @endif>
                        6 - 10 Days
                    </option>
                    <option value="11-15" @if(Input::get('duration')=='11-15' ) selected="selected" @endif>
                        11 - 15 Days
                    </option>
                    <option value="16-20" @if(Input::get('duration')=='16-20' ) selected="selected" @endif>
                        16 - 20 Days
                    </option>
                </select>
            </div>
            <div class="col l2 m6 s6">
                <select class="browser-default  bdr0" name="price">
                    <option value="">Select Price</option>
                    <option value="100 - 500" @if(Input::get('price')=='100 - 500' ) selected="selected" @endif>
                        $100 - $500
                    </option>
                    <option value="500 - 1000"
                            @if(Input::get('price')=='500 - 1000' ) selected="selected" @endif>$500 - $1000
                    </option>
                    <option value="1000 - 1500"
                            @if(Input::get('price')=='1000 - 1500' ) selected="selected" @endif>$1000 - $1500
                    </option>
                    <option value="1500 - 2000"
                            @if(Input::get('price')=='1500 - 2000' ) selected="selected" @endif>$1500 - $2000
                    </option>

                    <option @if(Input::get('price')=='2000 - 20000' ) selected="selected" @endif
                            value="2000 - 20000">$2000 and above</option>
                </select>
            </div>


            <div class="col l2 m6 s6" style="margin-bottom:15px;">
                <button class="btn btnfull">Search</button>
            </div>
        </div> <!--row end-->
    </form>
</div>