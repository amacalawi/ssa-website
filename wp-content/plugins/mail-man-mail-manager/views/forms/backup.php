<div class="main-form-panel tabbable-panel-disabled">
    <div class="tabbable-line">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#inquiry" aria-controls="inquiry" role="tab" data-toggle="tab">Register</a>
            </li>
            <li role="presentation"><a href="#registration" aria-controls="registration" role="tab" data-toggle="tab">Inquiry</a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="inquiry">
                <form id="<?php echo $options->ID ?>" <?php /*action="<?php echo $options->fallbackurl ?>"*/ ?> method="POST" role="form" class="contact-form">
                    <input name="action" type="hidden" value="send_message" />
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="contact[name]">Name</label>
                                <input value="<?php echo @$Name ?>" type="text" class="form-control" id="contact[name]" name="contact[name]" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="contact[email]">Email</label>
                                <input value="<?php echo @$Email ?>" type="email" class="form-control" id="contact[email]" name="contact[email]" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label" for="contact[phone]">Contact Number</label>
                                <input value="<?php echo @$Phone ?>" type="text" class="form-control input-medium bfh-phone" data-format="+63 ddd-ddd dddd" id="contact[phone]" name="contact[phone]" placeholder="Phone">
                            </div>
                        </div>
                    </div>
                    <div class="row courses-offered padding-top">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-label" for="contact[subject]">Courses</label>
                                <select name="register[course]" class="selectpicker form-control course-picker" title="Courses" data-live-search="true" data-header="Select Course and Course Level">
                                    <option>--Select Course--</option>
                                    <optgroup label="HiCPTA" data-subtext="The Certificate to Training Success">
                                        <option data-show="#course-level-basic" value="HiCPTA | Basic HiCPTA Certificate of Attainment (CU1 to CU4)">HiCPTA | Basic HiCPTA Certificate of Attainment (CU1 to CU4)</option>
                                        <option data-show="#course-level-advanced" value="HiCPTA | Advanced HiCPTA (CU5, CU6, and CU7)">HiCPTA | Advanced HiCPTA (CU5, CU6, and CU7)</option>
                                        <option data-show="#course-level-master" value="HiCPTA | Master Trainer - Design and Develop a Competency-Based Blended Learning Program">HiCPTA | Master Trainer - Design and Develop a Competency-Based Blended Learning Program</option>
                                    </optgroup>
                                    <optgroup label="ICDL" data-subtext="Lorem ipsum dolor sit amet.">
                                        <option value="hicpta-basic">ICDL | Basic ICDL Certificate of Attainment CU1 to CU4</option>
                                        <option value="hicpta-advanced">ICDL | Advanced ICDL (CU5, CU6, and CU7)</option>
                                        <option value="hicpta-master">ICDL | Design and Develop a Competency-Based Blended Learning  Program</option>
                                    </optgroup>
                                </select>
                                <ul class="list-group">
                                    <li class="list-group-item" role="button">Item 1</li>
                                    <li class="list-group-item" role="button">Item 2</li>
                                    <li class="list-group-item" role="button">Item 3</li>
                                </ul>
                            </div>
                        </div>
                        <div id="course-level-basic" class="col-sm-11 col-sm-offset-1 hidden-course">
                            <div class="form-group">
                                <label class="form-label" for="contact[course-level][basic]">HiCPTA | Basic Course Units</label>
                                <!-- <button type="button" class="close course-close" data-hide="#course-level-basic">&times;</button> -->
                                <select multiple id="contact[course-level][basic]" name="contact[course-level][basic]" class="selectpicker form-control" title="Select Course Units &amp; Schedule" data-live-search="true" data-header="Select Course Units &amp; Schedule">
                                    <option>--Select Course Units &amp; Schedule--</option>
                                    <optgroup data-max-options="1" label="Course Unit 1" data-subtext="Apply Adult Learning Principles and Code of Ethics in Training">
                                        <option value="February 06, 2016 (Saturday) - 8:00AM-5:00PM">February 06, 2016 (Saturday) - 8:00AM-5:00PM</option>
                                        <option value="February 13, 2016 (Saturday) - 8:00AM-5:00PM">February 13, 2016 (Saturday) - 8:00AM-5:00PM</option>
                                    </optgroup>
                                    <optgroup data-max-options="1" label="Course Unit 2" data-subtext="Prepare and Facilitate Classroom Training">
                                        <option value="February 19, 2016 (Friday) - 5:00PM-9:00PM">February 19, 2016 (Friday) - 5:00PM-9:00PM</option>
                                        <option value="February 20, 2016 (Saturday) - 8:00AM-5:00PM">February 20, 2016 (Saturday) - 8:00AM-5:00PM</option>
                                        <option value="February 26, 2016 (Friday) - 5:00PM-9:00PM">February 26, 2016 (Friday) - 5:00PM-9:00PM</option>
                                        <option value="February 27, 2016 (Saturday) - 8:00AM-5:00PM">February 27, 2016 (Saturday) - 8:00AM-5:00PM</option>
                                    </optgroup>
                                    <optgroup data-max-options="1" label="Course Unit 3" data-subtext="Develop a Competency-based Assessment">
                                        <option value="March 4, 2016 (Friday) - 5:00PM-9:00PM">March 4, 2016 (Friday) - 5:00PM-9:00PM</option>
                                        <option value="March 5, 2016 (Saturday) - 8:00AM-5:00PM">March 5, 2016 (Saturday) - 8:00AM-5:00PM</option>
                                        <option value="March 11, 2016 (Friday) - 5:00PM-9:00PM">March 11, 2016 (Friday) - 5:00PM-9:00PM</option>
                                        <option value="March 12, 2016 (Saturday) - 8:00AM-5:00PM">March 12, 2016 (Saturday) - 8:00AM-5:00PM</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                        <div id="course-level-advanced" class="col-sm-11 col-sm-offset-1 hidden-course">
                            <div class="form-group">
                                <label class="form-label" for="contact[course-level][advanced]">HiCPTA | Advanced Course Units</label>
                                <select multiple id="contact[course-level][advanced]" name="contact[course-level][advanced]" class="selectpicker form-control" title="Select Course Units &amp; Schedule" data-live-search="true" data-header="Select Course Units &amp; Schedule">
                                    <option>--Select Course Units &amp; Schedule--</option>
                                    <optgroup data-max-options="1" label="Course Unit 5" data-subtext="Design and Develop A Training Program">
                                        <option value="April 07, 2016 (Thursday) - 05:00PM-09:00PM">April 07, 2016 (Thursday) - 05:00PM-09:00PM</option>
                                        <option value="April 08, 2016 (Friday) - 05:00PM-09:00PM">April 08, 2016 (Friday) - 05:00PM-09:00PM</option>
                                        <option value="April 09, 2016 (Saturday) - 08:00AM-05:00PM">April 09, 2016 (Saturday) - 08:00AM-05:00PM</option>
                                        <option value="April 14, 2016 (Thursday) - 05:00PM-09:00PM">April 14, 2016 (Thursday) - 05:00PM-09:00PM</option>
                                        <option value="April 15, 2016 (Friday) - 05:00PM-09:00PM">April 15, 2016 (Friday) - 05:00PM-09:00PM</option>
                                    </optgroup>
                                    <optgroup data-max-options="1" label="Course Unit 6" data-subtext="Develop an On-the-Job Training Program">
                                        <option value="April 21, 2016 (Thursday) - 05:00PM-09:00PM">April 21, 2016 (Thursday) - 05:00PM-09:00PM</option>
                                        <option value="April 22, 2016 (Friday) - 05:00PM-09:00PM">April 22, 2016 (Friday) - 05:00PM-09:00PM</option>
                                        <option value="April 23, 2016 (Saturday) - 05:00PM-09:00PM">April 23, 2016 (Saturday) - 05:00PM-09:00PM</option>
                                    </optgroup>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label" for="contact[message]">Note</label>
                                <textarea id="contact[message]" class="form-control" name="contact[message]" placeholder="Note"><?php echo @$Message ?></textarea>
                            </div>
                            <button type="submit" name="contact[submit]" class="pull-right ladda-button btn btn-gold btn-lg text-uppercase progress-button" data-style="expand-left">Register</button>
                        </div>
                    </div>
                </form>
            </div>
            <div role="tabpanel" class="tab-pane" id="registration">
                <p class="text-center">lorem ipsum dolor sit amet</p>
                <form id="<?php echo $options->ID ?>_reg" <?php /*action="<?php echo $options->fallbackurl ?>"*/ ?> method="POST" role="form" class="contact-form">
                    <input name="action" type="hidden" value="send_message" />
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="sr-only" for="contact[name]">Name</label>
                                <input value="<?php echo @$Name ?>" type="text" class="form-control" id="contact[name]" name="contact[name]" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="sr-only" for="contact[email]">Email</label>
                                <input value="<?php echo @$Email ?>" type="email" class="form-control" id="contact[email]" name="contact[email]" placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" name="contact[message]" placeholder="Message"><?php echo @$Message ?></textarea>
                            </div>
                            <button type="submit" name="contact[submit]" class="pull-right ladda-button btn btn-gold btn-lg text-uppercase progress-button" data-style="expand-left">Send</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <form id="<?php echo $options->ID ?>" <?php /*action="<?php echo $options->fallbackurl ?>"*/ ?> method="POST" role="form" class="contact-form">
    <input name="action" type="hidden" value="send_message" />
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <label class="sr-only" for="contact[name]">Name</label>
                <input value="<?php echo @$Name ?>" type="text" class="form-control" id="contact[name]" name="contact[name]" placeholder="Name">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label class="sr-only" for="contact[email]">Email</label>
                <input value="<?php echo @$Email ?>" type="email" class="form-control" id="contact[email]" name="contact[email]" placeholder="Email">
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <textarea class="form-control" name="contact[message]" placeholder="Message"><?php echo @$Message ?></textarea>
            </div>
            <button type="submit" name="contact[submit]" class="pull-right ladda-button btn btn-gold btn-lg text-uppercase progress-button" data-style="expand-left">Send</button>
        </div>
    </div>
</form> -->