@extends('layouts.master')

<!-- Author form to add authors associated with research papers and posters -->


@section('content')


<h3 class="bold">Coaching in Leadership and Healthcare 2016: Poster Application</h3>

<div class="content">
	<p>To delete your submission for consideration in the Coaching in Leadership and Healthcare 2016 conference,
		click the "DELETE" button below to confirm you would like to continue with the delete process.</p>

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

		<!-- Form to gather user data -->

		<br>

				<form method="POST" id="delete_form" action="/research/delete">

				<!-- CSRF token for safety -->
				<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" >
				<input type="hidden" name="research_id" value=" {{ session('research[id]') }}  " >

				<br>
				@for ($i = 0; $i < $count; $i++)
					<fieldset>
						<legend><span class="bold"><input type="radio" name="research_id" value=" {{ $researches[$i]->id  }}  " >&nbsp; &nbsp;Select This Research Submission To Delete</span></legend>
									<span class="bold">Your submission is for a research:</span> {{ $researches[$i]->type }}<br>
									<span class="bold">Title:</span> {{ $researches[$i]->title }} <br>
									<span class="bold">Type:</span> {{ $researches[$i]->type }} <br>
									@if ($researches[$i]->type == "Paper" || $researches[$i]->type == "Both")
									<span class="bold">Track:</span> {{ $researches[$i]->track }} <br>
									@endif
									<br>
									<span class="bold">Background and Objectives:</span> {{ $researches[$i]->research }} <br>
									<br>
									<span class="bold">Abstract:</span> {{ $researches[$i]->abstract }} <br>
							    <br>
						<legend><span class="bold">Authors</span></legend>
									<span class="bold">Main Author:</span> {{ $user->first }} {{ $user->last }}<br>
									<br>
									@for ($n = 0; $n < $researches[$i]->auth_count; $n++)
									<?php $first = "first" . $n; $last = "last" . $n; $org = "org" . $n; ?>
									<span class="bold">Co-Author:</span> {{ $researches[$i]->$first }} {{ $researches[$i]->$last }}
									       <span class="bold">Organization: </span>{{ $researches[$i]->$org }}<br>
									<br>
									@endfor


											</fieldset>
											<br>
					@endfor


				<br>
				<input type ="submit" value="DELETE">
				</form>
</div>
@stop
