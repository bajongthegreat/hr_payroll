
<?php 
  $filter_params = (array) json_decode(urldecode(Input::get('filterby')));
  $membership_status = ['associate' => 'Casual', 'regular' => 'Regular'];
?>
<div class="panel-group" id="accordion">
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapseOne">
                                Company
                              </a>
                            </h4>
                          </div>
                          <div id="collapseOne" class="panel-collapse collapse in">
                            <div class="panel-body">
                              <ul class="list-group filter-list" style="font-size: 12px; font-weight: bold; list-style:none;" data-category="company_id" data-limit="1">
                                
                                  @foreach($companies as $company)

                                  @if (isset($filter_params['company_id']))
                                        @if (in_array($company->id, $filter_params['company_id']))
                                           <li><input type="checkbox" data-fieldvalue="{{ $company->id }}"  class="filter-item" checked> {{ $company->name}}  </li>
                                        @else 
                                          <li><input type="checkbox" data-fieldvalue="{{ $company->id }}"  class="filter-item"> {{ $company->name}}  </li>
                                        @endif
                                  @else
                                    <li><input type="checkbox" data-fieldvalue="{{ $company->id }}"  class="filter-item"> {{ $company->name}}  </li>
                                  @endif
                                   
                                  @endforeach
                               </ul>
                            </div>
                          </div>
                        </div>
                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse" href="#collapseTwo">
                                Position
                              </a>
                            </h4>
                          </div>
                          <div id="collapseTwo" class="panel-collapse collapse in">
                            <div class="panel-body">
                            <ul class="list-group filter-list" style="font-size: 12px; font-weight: bold; list-style:none;" data-category="position_id" data-limit="5">
                                   @foreach($positions as $position)

                                   @if (isset($filter_params['position_id']))
                                        @if (in_array($position->id, $filter_params['position_id']))
                                           <li><input type="checkbox" data-fieldvalue="{{ $position->id }}"  class="filter-item" checked> {{ $position->name}}  </li>
                                        @else 
                                          <li><input type="checkbox" data-fieldvalue="{{ $position->id }}"  class="filter-item"> {{ $position->name}}  </li>
                                        @endif
                                  @else
                                   <li><input type="checkbox" data-fieldvalue="{{ $position->id }}"  class="filter-item"> {{ $position->name}}  </li>
                                  @endif

                                  @endforeach
                               </ul>
                             </div>
                          </div>
                        </div>


                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse"  href="#collapse3">
                                Membership status
                              </a>
                            </h4>
                          </div>
                          <div id="collapse3" class="panel-collapse collapse">
                            <div class="panel-body">
                            <ul class="list-group filter-list" style="font-size: 12px; font-weight: bold; list-style:none;" data-category="membership_status" data-limit="5">
                                   

                                 @foreach($membership_status as $key => $value)

                                   @if (isset($filter_params['membership_status']))
                                        @if (in_array($key, $filter_params['membership_status']))
                                           <li><input type="checkbox" data-fieldvalue="{{ $key }}"  class="filter-item" checked> {{ $value}}  </li>
                                        @else 
                                          <li><input type="checkbox" data-fieldvalue="{{ $key }}"  class="filter-item"> {{ $value}}  </li>
                                        @endif
                                  @else
                                   <li><input type="checkbox" data-fieldvalue="{{ $key }}"  class="filter-item"> {{ $value}}  </li>
                                  @endif

                                  @endforeach


                               </ul>
                             </div>
                          </div>
                        </div>

                        <div class="panel panel-default">
                          <div class="panel-heading">
                            <h4 class="panel-title">
                              <a data-toggle="collapse"  href="#collapse4">
                                Employment Status
                              </a>
                            </h4>
                          </div>
                          <div id="collapse4" class="panel-collapse collapse">
                            <div class="panel-body">
                            <ul class="list-group filter-list" style="font-size: 12px; font-weight: bold; list-style:none;" data-category="employment_status" data-limit="5">
                                    @foreach($employment_status as $key => $value)

                                   @if (isset($filter_params['employment_status']))
                                        @if (in_array($key, $filter_params['employment_status']))
                                           <li><input type="checkbox" data-fieldvalue="{{ $key }}"  class="filter-item" checked> {{ $value}}  </li>
                                        @else 
                                          <li><input type="checkbox" data-fieldvalue="{{ $key }}"  class="filter-item"> {{ $value}}  </li>
                                        @endif
                                  @else
                                   <li><input type="checkbox" data-fieldvalue="{{ $key }}"  class="filter-item"> {{ $value}}  </li>
                                  @endif

                                   @endforeach
                               </ul>
                             </div>
                          </div>
                        </div>
                       
                      </div>