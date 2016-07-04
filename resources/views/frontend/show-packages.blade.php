                    
                        @foreach ($packages->chunk(3) as $chunk)
                        <div class="row">
                        @foreach($chunk as $package)
                        
                        <div class="col l4 m6 s12 mgb25">
                           <div class="trip_img">                           
                              <a href="{{ route('package.detail', $package->slug) }}">
                                 @if(count($package->coverGallery) > 0)
                                 @foreach($package->coverGallery as $gallery)
                                 @endforeach 
                                 @if(file_exists('uploads/gallery/thumbs/'.$gallery->thumb_attachment) && $gallery->thumb_attachment != '')
                                 <img src="{{ asset('uploads/gallery/thumbs/'.$gallery->thumb_attachment) }}"/>
                                 @else
                                 <img src="{{ asset('images/special1.jpg') }}"/>
                                 @endif
                                 @else
                                 <img src="{{ asset('images/special1.jpg') }}"/>
                                 @endif
                              </a>
                              </div>
                           <div class="trip_brief">
                              <div class="trip_price">{{ '$'.$package->starting_price }}<br><span>{{ '$'.$package->previous_price }}</span></div>
                              <div class="trip_title"><a href="{{ route('package.detail', $package->slug) }}">
                                 {{ str_limit($package->heading, 50) }}
                              </a></div>
                              <div class="trip_fact_brief">
                                 <div class="row">
                                    @if($package->trip_duration)
                                    <div class="col l6 m6 s6">Duration: {{ $package->trip_duration }} Days</div>
                                    @endif
                                 <!--    <div class="col l6 m6 s6">Rating: <img src="images/rating.png"></div>
                                  --></div>
                              </div>
                              <div class="trip_btns">
                                 <a href="{{ route('package.detail', $package->slug) }}" class="btn green">Details</a>
                                 <a href="{{ route('package.detail', $package->slug) }}" class="btn ">Book Now</a>
                              </div>
                           </div>
                        </div>
                        <!--col end-->
                        @endforeach 
                     </div>
                     @endforeach
                     {!! $packages->render() !!}
                     <!-- <ul class="pagination">
                        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
                        <li class="active"><a href="#!">1</a></li>
                        <li class="waves-effect"><a href="#!">2</a></li>
                        <li class="waves-effect"><a href="#!">3</a></li>
                        <li class="waves-effect"><a href="#!">4</a></li>
                        <li class="waves-effect"><a href="#!">5</a></li>
                        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                     </ul> -->