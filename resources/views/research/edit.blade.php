@extends('layouts.master')

<!-- Author form to add authors associated with research papers and posters -->


@section('content')
<h1>Coaching in Leadership and Healthcare 2017: Poster Application</h1>

<div class="content">
	<p>Please provide information for your research submission (paper or poster) for consideration in the Coaching in Leadership and Healthcare 2016 conference, scheduled September 16-17, 2016. After providing the requested information for your research paper or poster, you'll be directed to the form to input author information.</p>

		@if(count($errors)  > 0)
		  <ul>
		      @foreach ($errors->all() as $error)
		        <li><span class="red">{{ $error }}</span></li>
		      @endforeach
		  </ul>
		@endif

		@if(Session::get('message') != null)
	         <div class='flash_message'>{{ Session::get('message') }}</div>
	     @endif


		<!-- Form to gather user data -->

		<br>
				<form method="POST" id="researchEdit_form" action="/research/edit">

				<!-- CSRF token for safety -->
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >

			<!-- 	@foreach($researches as $research) -->

					<input type="hidden" form="researchEdit_form" name="research_id" value=" {{ $research->id }} " >

					<fieldset>

					<legend><span class="bold">Authors</span></legend>

					<legend>Research Information</legend></br>
			      <p><strong>Research Presentation Format:&nbsp;&nbsp;</strong>Indicate if you wish to present your research as an oral paper or a poster. If you select "Both", the reviewers will decide whether the research will be presented orally or as a poster.</p>
						<select form="researchEdit_form" id="paper_poster" name="type" value='{{ $research->type }}'>
			          <option selected>-----</option>
								<option id="poster" name="poster" value="Poster" @if ( $research->type == "Poster" ) selected="selected" @endif>Poster</option>
								<option id="paper" name="paper" value="Paper"  @if ( $research->type == "Paper") selected="selected" @endif>Paper</option>
								<option id="both_research" name="both" value="Both"  @if ( $research->type == "Both") selected="selected" @endif>Both</option>
			      </select>
			      <br>
			      <br>
						<div id="paper_track">
			      <p><strong>Paper Track Selection:&nbsp;&nbsp;</strong>Indicate which track you would like to present your research.</p>
			      <select form="researchEdit_form" id="track" name="track" value='{{ $research->track }}'>
			          <option selected>-----</option>
								<option id="leadership" name="lead" value="Leadership" @if ( $research->track == "Leadership" ) selected="selected" @endif>Leadership</option>
								<option id="both_track" name="both_track" value="Both" @if ( $research->track == "Both" ) selected="selected" @endif>Both</option>
								<option id="health" name="health" value="Health" @if ( $research->track == "Health" ) selected="selected" @endif>Health</option>
			      </select>
					  </div>
			      <br>
			      <br>
			      <p><strong>Research Title:  </strong><textarea form="researchEdit_form" id="title" name="title" placeholder="Please enter a title" value='{{ $research->title }}' rows="2" cols="70">{{ $research->title }}</textarea></p>
			      <div id="title_count"></div>
						<br>
			      <p><strong>Research Information:  </strong>Describe the Background and Objectives; Design and Methods; Findings and Discussion. <strong>500 word limit for this section.</strong></p>
			      <textarea form="researchEdit_form" name="research" value='{{ $research->research }}'  rows="10" cols="100" id="research" >{{ $research->research }}</textarea>
			      <div id="research_count"><strong>500 word limit for Research Description. Total words so far: </strong></div>
						<br>
			      <p><strong>Research Abstract:  </strong>Summarize the Background and Objectives; Design and Methods; Findings and Discussion into a short abstract that will be published in the conference syllabus. <strong>250 word limit for this section.</strong></p>
			      <textarea id="abstract" name="abstract" value='{{ $research->abstract }}' form="researchEdit_form"  min="2" max="200" rows="6" cols="100">{{ $research->abstract }} </textarea>
			      <div id="abstract_count"><strong>250 word limit for Abstract. Total words so far: </strong></div>
			      <br>
						<br>
						<legend>Authors</legend>
						<p><strong>Co-Authors:&nbsp;&nbsp;</strong>Add a maximum of five co-authors. Click the "Add Author" button to add additional fields.</p>

						@for ($n = 0; $n < $research->auth_count; $n++)
						<?php $first = "first" . $n; $last = "last" . $n; ?>
		<!--				<span class="bold">Co-Author:</span> {{ $research->$first }} {{ $research->$last }}<br>  -->
						<strong>First Name:&nbsp;&nbsp;&nbsp;</strong><textarea id='{{$first}}' form="researchEdit_form" class="first" name='{{$first}}' value="" rows="1" cols="35">{{ $research->$first }}</textarea>&nbsp;&nbsp;&nbsp;
						<strong>Last Name:&nbsp;&nbsp;&nbsp;</strong><textarea id='{{$last}}' form="researchEdit_form" class="last" name='{{$last}}'  value="" rows="1" cols="35">{{ $research->$last }}</textarea><br>
						@endfor

						@if ($research->auth_count < 5)
			      <div id="authors">
						<span class="bold">Co-Authors: </span><br>
						</div>
						<input type="text" id="countAuths" form="researchEdit_form" name="countAuths" value="{{ $count }}">{{ $count }}
						<button type="button" id="auth_button" class="button">Add Author</button><br><br>
						@else
						<strong><p>You have reached the maximum of 5 Co-Authors.</p></strong>
						@endif

		<!--		@endforeach  -->
				</fieldset>
				<br>
				</form>
				<button id="submit" form="researchEdit_form" class="button">SUBMIT</button><br><br>

</div>
@stop
