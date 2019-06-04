<section id="slider"><!--slider-->
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    @php
                        $sliders = DB::table('sliders')
                        ->where('active',1)
                        ->get();
                    @endphp
                    <ol class="carousel-indicators">
                            @foreach( $sliders as $slider )
                                <li data-target="#slider-carousel" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                            @endforeach
                        </ol>
                    
                    <div class="carousel-inner">
                        
                        @foreach ($sliders as $slider)
                            
                        
                        <div class="carousel-item  @if ($loop->first) active @endif">
                            <img src="{{Storage::url($slider->image)}}" class="img-fluid" alt=""  />
                        </div>
                        @endforeach
                    </div>
                    
                    <a href="#slider-carousel" class="left carousel-control-prev hidden-xs " data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right carousel-control-next  hidden-xs " data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
</section><!--/slider-->