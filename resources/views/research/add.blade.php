@extends('layouts.master')

<!-- Author form to add authors associated with research papers and posters -->

@section('content')

<div class="content">

<h3 class="bold">Coaching in Leadership and Healthcare 2018: Paper and Poster Application</h3>
<br>

@if(count($errors)  > 0)
	<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
	</ul>
@endif

@if(Session::get('message') != null)
			 <div class='flash_message'>{{ Session::get('message') }}</div>
	 @endif

	<p>Please provide information for your research submission (paper or poster) for consideration in the Coaching in
		Leadership and Healthcare 2018 conference. To make a submission, please review the information below and complete
		the research form.</p>
		<br>

		<!-- Form to gather user data -->

				<form method="POST" role="form" id="research_form" action="/research">
				<!-- CSRF token for safety -->
			 	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >

				<fieldset>
				<legend>Research Information</legend></br>
				<p><strong>Co-authors:&nbsp;&nbsp;</strong>Add a maximum of five co-authors. Click the "Add Author" button to add additional fields.</p>

				<div id="authors">

				<?php $countAuths=0; ?>
	      <p><strong>First Name:&nbsp;&nbsp;&nbsp;</strong><textarea id="first0" class="first" name="first0" value="" rows="1" cols="40"></textarea>&nbsp;&nbsp;&nbsp;
	      <strong>Last Name:&nbsp;&nbsp;&nbsp;</strong><textarea id="last0" class="last" name="last0"  value="" rows="1" cols="40"></textarea><br><br>
			  <strong>Organization:&nbsp;&nbsp;&nbsp;</strong><textarea id="org0" class="org" name="org0" value="" rows="1" cols="40"></textarea></p>
			  </div>

				<input type="text" id="countAuths" name="countAuths" value="<?php echo $countAuths ?>">
	      <button type="button" id="auth_button" class="button">Add Author</button><br><br>
				<br>
	      <p><strong>Research Presentation Format:&nbsp;&nbsp;</strong>Indicate if you wish to present your research as an oral paper or a poster. If you select "Both", the reviewers will decide whether the research will be presented orally or as a poster.</p>
				<select form="research_form" id="paper_poster" name="type" value='{{ old('type') }}'>
	          <option selected>-----</option>
	          <option id="paper" name="paper" value="Paper">Paper</option>
	          <option id="poster" name="poster" value="Poster">Poster</option>
	          <option id="both_research" name="both" value="Both">Both</option>
	      </select>
	      <br>
	      <br>
	      <div id="paper_track">
	      <p><strong>Paper Track Selection:&nbsp;&nbsp;</strong>Indicate which track you would like to present your research.</p>
	      <select form="research_form" id="track" name="track" value='{{old('track') }}'>
	          <option selected>-----</option>
	          <option id="leadership" name="lead" value="Leadership">Leadership</option>
	          <option id="health" name="health" value="Health">Health</option>
	          <option id="both_track" name="both_track" value="Both">Both</option>
	      </select>
	      <br>
	      </div>
	      <br>
	      <p><strong>Research Title:&nbsp;&nbsp;</br>
				</strong><textarea form="research_form" id="title" name="title" placeholder="Please enter a title" value='{{ old('title') }}' rows="1" cols="120"></textarea></p>
	      <div id="title_count"></div>
				<br>
	      <p><strong>Research Information: </strong>Describe the Background and Objectives; Design and Methods; Findings and Discussion. <strong>500 word limit for this section.</strong></p>
	      <textarea form="research_form" name="research" value='{{ old('research') }}'  rows="10" cols="120" id="research" ></textarea>
	      <div id="research_count"><strong>500 word limit for Research Description. Total words so far: </strong></div>
				<br>
				<br>
	      <p><strong>Research Abstract: </strong>Summarize the Background and Objectives; Design and Methods; Findings and Discussion into a short abstract that will be published in the conference syllabus. <strong>250 word limit for this section.</strong></p>
	      <textarea id="abstract" name="abstract" value='{{ old('abstract', '') }}' form="research_form"  min="2" max="200" rows="6" cols="120"></textarea>
	      <div id="abstract_count"><strong>200 word limit for Abstract. Total words so far: </strong></div>
				</form>
	      <br>
				<br>
				</fieldset>

		    <button id="submit" form="research_form" class="button">SUBMIT</button><br><br>
</div>
@stop
