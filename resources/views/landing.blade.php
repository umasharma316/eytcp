@extends('layouts.mooc_layout')
@section('style')
<style type="text/css">
    nav {
     background: linear-gradient(235deg, #d7d7d7, #414141); 
    background-color: transparent;
    box-shadow:none;

  }
  canvas {
  height: 100%;
  width: 100%;
  position: absolute;
}
</style>
@stop
@section('content')
<div class="banner" id="home">
<div class="clearfix"></div>
  <div class="banner-main">
    <div class="">
    <div class="row">
      <div class="col s7">
        <div class="banner-top center-align">
          <h1 style="text-transform:none; padding-left: 20px;">e-Yantra Teacher Certification Program</h1>
        </div>
      </div>
      <!-- <div class="col s2 center-align">
       <div class="moving-zone" id="feedback">
          <div class="popup">         
              <div class="popup-content">                 
                  <div class="popup-text">
                    <a href="#courseFee"><b>Fees: 500 INR</b></a>
                  </div>
              </div>
          </div>
        </div>

      </div> -->
      <div class="col s3 left-align">
        
        <img src="{!! asset('/img/MascotRobo/spaceBot.png') !!}" style="padding-left: 0px;">
        
      </div>
    </div>
    </div>
  </div>
</div>
</div>

<div class="body-img" id="index">
<section id='body_content'>
<div class="row">
  <div class="col s6">
    <h2>Introduction</h2>
   Crash Course is an online platform developed by e-Yantra, to offer Massive Open Online Courses (MOOCs) for individuals from varying backgrounds. We encourage students in Engineering/ Science/ Polytechnic colleges to take advantage of the courses.<br/><br/>
   Our 4 Weeks Course is offered along with a challenge activity to help you hone your acquired skills. This is like a “mini-theme” of our popular e-Yantra Robotics Competition. 
   <h4><b>GOAL</b></h4>
   <ol>
     <li>Introduce the power of “Project Based Learning”</li>
     <li>Promote the study of Embedded Systems and Robotics</li>
     <li>Prepare students for National level Robotics Competition</li>
     <li>Ensure sustained use of robotics labs set up through eLSI</li>
     <li>Nurture BE projects in Embedded Systems and Robotics at eLSI colleges</li>
   </ol>
  </div>
  <div class="col s6 center-align">
    <img src="{!! asset('/img/MascotRobo/eyrdc.png') !!}" style="padding-top: 50px;">
  </div>
</div>
<div class="row">
  <div class="col s6">
     <img src="{!! asset('/img/MascotRobo/running bot.png') !!}" style="padding-left: 40px;">
  </div>
  <div class="col s6">
      <h2>Who can Participate?</h2>
      <ol class="indented_ul">
        <li>Any TBT Challenge Merit Holders</li>
        <li>eYIC Active Mentors.</li>
        <li>eYRDC Active Teachers.</li>
      </ol> 
  </div>
</div>  
<!-- <div class="row">
  <div class="col s6">
    <h2>How to Apply for the Course?</h2>
      <ol class="indented_ul">
        <li>Enrollment is strictly online - no other mode of application will be entertained.</li>
        <li>Click on Register Button available on top right corner of this page</li>
        <li>Fill the registration form and submit alongwith valid scan of student (college) ID card.</li>
        <li>On successful registration, the student will receive an acknowledgement email.</li>
        <li>After the verification process, accepted students will receive a notification for online payment.</li>
        <li>On successful payment, the student will receive login credentials for MOOC portal and he/she will be enrolled for the 4 weeks paid Embedded Systems and Robotics course.</li>
      </ol>
  </div>
  <div class="col s6 center-align">
    <img src="{!! asset('/img/MascotRobo/sun.png') !!}" style="padding-left: 10px;">
  </div>
</div> -->

<!-- <div class="row">
  <div class="col s4 offset-s2" style="padding-top: 30px;">
    <img src="{!! asset('/img/MascotRobo/winner.png') !!}" style="padding-left: 0px;">
  </div>
  <div class="col s6" id="courseFee">
    <h2>Course Fee</h2>
      <ol class="indented_ul">
        <li>The course fee for each student is Rs. 500/- (50% introductory discount included) - to be paid after the verification process.</li>
        <li>The course fees are mandatory to take benefit of the course</li>
        <li>Details regarding Online Payment will be soon provided after verification process.</li>
      </ol>
    Please note that the registration fee once paid is neither refundable nor adjustable under any circumstances<br/><br/>
    <h2>Criteria for Certification</h2>
      <ol class="indented_ul">
        <li>E-certificate will be provided to the participants after successful completion of the course.</li>
        <li>Top performing students are eligible for</li>
        <ol>
          <li>Merit Certificates, </li>
          <li>Goodies and</li>
          <li>Chance to win Internship</li>
        </ol>
      </ol>
    <strong style="color: red;">*</strong>e-Yantra holds complete discretion to change/update the rules as necessary.
  </div>
</div> -->

  </section>
  </div>
@stop
@section('script')
<script type="text/javascript">
var moveForce = 30; // max popup movement in pixels
var rotateForce = 20; // max popup rotation in deg

$(document).mousemove(function(e) {
    var docX = $(document).width();
    var docY = $(document).height();
    
    var moveX = (e.pageX - docX/2) / (docX/2) * -moveForce;
    var moveY = (e.pageY - docY/2) / (docY/2) * -moveForce;
    
    var rotateY = (e.pageX / docX * rotateForce*2) - rotateForce;
    var rotateX = -((e.pageY / docY * rotateForce*2) - rotateForce);
    
    $('.popup')
        .css('left', moveX+'px')
        .css('top', moveY+'px')
        .css('transform', 'rotateX('+rotateX+'deg) rotateY('+rotateY+'deg)');
});
(function(){

  window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame;

  var canvas = document.querySelector("canvas");
  canvas.width = window.innerWidth
  canvas.height = window.innerHeight;
  var ctx = canvas.getContext("2d");
  ctx.globalCompositeOperation = "source-over";
  var particles = [];
  var pIndex = 0;
  var x, y, frameId;

  function Dot(x,y,vx,vy,color){
    this.x = x;
    this.y = y;
    this.vx = vx;
    this.vy = vy;
    this.color = color;
    particles[pIndex] = this;
    this.id = pIndex;
    pIndex++;
    this.life = 0;
    this.maxlife = 600;
    this.degree = getRandom(0,360);
    this.size = Math.floor(getRandom(8,10));
  };

  Dot.prototype.draw = function(x, y){

    this.degree += 1;
    this.vx *= 0.99;
    this.vy *= 0.999;
    this.x += this.vx+Math.cos(this.degree*Math.PI/180);
    this.y += this.vy;
    this.width = this.size;
    this.height = Math.cos(this.degree*Math.PI/45)*this.size;
    
    ctx.fillStyle = this.color;
    ctx.beginPath();
    ctx.moveTo(this.x+this.x/2, this.y+this.y/2);
    ctx.lineTo(this.x+this.x/2+this.width/2, this.y+this.y/2+this.height);
    ctx.lineTo(this.x+this.x/2+this.width+this.width/2, this.y+this.y/2+this.height);
    ctx.lineTo(this.x+this.x/2+this.width, this.y+this.y/2);
    ctx.closePath();
    ctx.fill();
    this.life++;
    if(this.life >= this.maxlife){
      delete particles[this.id];
    }
  }
  window.addEventListener("resize", function(){
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;
    x = canvas.width / 2;
    y = canvas.height / 2;
  });

  function loop(){
    ctx.clearRect(0,0, canvas.width, canvas.height);
    if(frameId % 3 == 0) {
        new Dot(canvas.width*Math.random()-canvas.width+canvas.width/2*Math.random(), -canvas.height/2, getRandom(1, 3),  getRandom(2, 4),"#EF145D");
        new Dot(canvas.width*Math.random()+canvas.width-canvas.width*Math.random(), -canvas.height/2,  -1 * getRandom(1, 3),  getRandom(2, 4),"#FFF");
    }
    for(var i in particles){
      particles[i].draw();
    }
    frameId = requestAnimationFrame(loop);
  }

  loop();

  function getRandom(min, max) {
    return Math.random() * (max - min) + min;
  }

})();
</script>
@stop