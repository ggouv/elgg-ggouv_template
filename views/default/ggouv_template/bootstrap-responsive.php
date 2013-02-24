/*!
 * Bootstrap Responsive v2.0.4
 *
 * Copyright 2012 Twitter, Inc
 * Licensed under the Apache License v2.0
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Designed and built with all the love in the world @twitter by @mdo and @fat.
 */

.hide-text {
  font: 0/0 a;
  color: transparent;
  text-shadow: none;
  background-color: transparent;
  border: 0;
}

.visible-phone {
  display: none !important;
}

.visible-tablet {
  display: none !important;
}

.hidden-desktop {
  display: none !important;
}

@media (max-width: 767px) {
  .visible-phone {
    display: inherit !important;
  }
  .hidden-phone {
    display: none !important;
  }
  .hidden-desktop {
    display: inherit !important;
  }
  .visible-desktop {
    display: none !important;
  }
}

@media (min-width: 768px) and (max-width: 979px) {
  .visible-tablet {
    display: inherit !important;
  }
  .hidden-tablet {
    display: none !important;
  }
  .hidden-desktop {
    display: inherit !important;
  }
  .visible-desktop {
    display: none !important ;
  }
}

@media (min-width: 1200px) {
  .row {
    *zoom: 1;
  }
  .row:before,
  .row:after {
    display: table;
    content: "";
  }
  .row:after {
    clear: both;
  }
  [class*="span"] {
    float: left;
    margin-left: 30px;
  }
  .span12 {
    width: 1170px;
  }
  .span11 {
    width: 1070px;
  }
  .span10 {
    width: 970px;
  }
  .span9 {
    width: 870px;
  }
  .span8 {
    width: 770px;
  }
  .span7 {
    width: 670px;
  }
  .span6 {
    width: 570px;
  }
  .span5 {
    width: 470px;
  }
  .span4 {
    width: 370px;
  }
  .span3 {
    width: 270px;
  }
  .span2 {
    width: 170px;
  }
  .span1 {
    width: 70px;
  }
  .offset12 {
    margin-left: 1230px;
  }
  .offset11 {
    margin-left: 1130px;
  }
  .offset10 {
    margin-left: 1030px;
  }
  .offset9 {
    margin-left: 930px;
  }
  .offset8 {
    margin-left: 830px;
  }
  .offset7 {
    margin-left: 730px;
  }
  .offset6 {
    margin-left: 630px;
  }
  .offset5 {
    margin-left: 530px;
  }
  .offset4 {
    margin-left: 430px;
  }
  .offset3 {
    margin-left: 330px;
  }
  .offset2 {
    margin-left: 230px;
  }
  .offset1 {
    margin-left: 130px;
  }
  .row-fluid {
    width: 100%;
    *zoom: 1;
  }
  .row-fluid:before,
  .row-fluid:after {
    display: table;
    content: "";
  }
  .row-fluid:after {
    clear: both;
  }
  .row-fluid [class*="span"] {
    display: block;
    float: left;
    width: 100%;
    min-height: 28px;
    margin-left: 2.564102564%;
    *margin-left: 2.510911074638298%;
    -webkit-box-sizing: border-box;
       -moz-box-sizing: border-box;
        -ms-box-sizing: border-box;
            box-sizing: border-box;
  }
  .row-fluid [class*="span"]:first-child {
    margin-left: 0;
  }
  .row-fluid .span12 {
    width: 100%;
    *width: 99.94680851063829%;
  }
  .row-fluid .span11 {
    width: 91.45299145300001%;
    *width: 91.3997999636383%;
  }
  .row-fluid .span10 {
    width: 82.905982906%;
    *width: 82.8527914166383%;
  }
  .row-fluid .span9 {
    width: 74.358974359%;
    *width: 74.30578286963829%;
  }
  .row-fluid .span8 {
    width: 65.81196581200001%;
    *width: 65.7587743226383%;
  }
  .row-fluid .span7 {
    width: 57.264957265%;
    *width: 57.2117657756383%;
  }
  .row-fluid .span6 {
    width: 48.717948718%;
    *width: 48.6647572286383%;
  }
  .row-fluid .span5 {
    width: 40.170940171000005%;
    *width: 40.117748681638304%;
  }
  .row-fluid .span4 {
    width: 31.623931624%;
    *width: 31.5707401346383%;
  }
  .row-fluid .span3 {
    width: 23.076923077%;
    *width: 23.0237315876383%;
  }
  .row-fluid .span2 {
    width: 14.529914530000001%;
    *width: 14.4767230406383%;
  }
  .row-fluid .span1 {
    width: 5.982905983%;
    *width: 5.929714493638298%;
  }
}