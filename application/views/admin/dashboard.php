<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script type="text/javascript">
    google.load("visualization", "1", {packages: ["corechart"]});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Days', 'No. of view'],
            ['01 May', 1000],
            ['02 May', 1170],
            ['03 May', 660],
            ['04 May', 332],
            ['05 May', 454],
            ['06 May', 345],
            ['07 May', 545],
            ['08 May', 234],
            ['09 May', 233]
        ]);

        var options = {
            title: 'DateClip by Day'
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    }
</script>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
	<h1 class="page-header"><span class="glyphicon glyphicon-dashboard"></span> Dashboard</h1>

	<div class="row">

		<div class="col-md-6">
			<p><span class="glyphicon glyphicon-log-in"></span> You have last logged in on: <?php echo $this->session->userdata('last_login');?></p>
			<div class="panel panel-info">
		        <!-- Default panel contents -->
		        <div class="panel-heading">Profile Statistics</div>
		        <div class="panel-body">
		            <p><span class="glyphicon glyphicon-user"></span> Total Profile: <strong><?php echo $dashboard['total_profile'];?></strong></p>
		            <p><span class="glyphicon glyphicon-heart"></span> Female Profile: <strong><?php echo $dashboard['female_profile'];?></strong></p>
		            <p><span class="glyphicon glyphicon-heart-empty"></span> Male Profile: <strong><?php echo $dashboard['male_profile'];?></strong></p>
		            <p><span class="glyphicon glyphicon-star"></span> Avg. Popularity of all Female Users: <strong>63%</strong></p>
					<p><span class="glyphicon glyphicon-star-empty"></span> Avg. Popularity of all Male Users: <strong>45%</strong></p>
		        </div>
		    </div>
		</div>
		<div class="col-md-6">
			<p>&nbsp</p>
			<div class="panel panel-info">
		        <!-- Default panel contents -->
		        <div class="panel-heading">DateClip Statistics</div>
		        <div class="panel-body">
		 		<p><span class="glyphicon glyphicon-facetime-video"></span> Numbers of Users with DateClips: <strong><?php echo $dashboard['has_dateclip'];?></strong></p>
					<p><span class="glyphicon glyphicon-ban-circle"></span> Numbers of Users without DateClips: <strong><?php echo ($dashboard['total_profile'] - $dashboard['has_dateclip']);?></strong></p>
					<p><span class="glyphicon glyphicon-stats"></span> Numbers of Potential Users who did not set up an account: <strong>665</strong></p>
		        </div>
		    </div>
		</div>
	</div>

    <div class="row">
    	<div class="col-md-12">
		    <div class="panel panel-success">
		        <!-- Default panel contents -->
		        <div class="panel-heading">DateClip by Day</div>
		        <div class="panel-body">
		            <div id="chart_div" style="width: 100%; height: 100%;"></div>
		        </div>
		    </div>
		</div>
	</div>

    <!-- <div class="row placeholders">
    	<div class="col-xs-4 col-sm-4 placeholder">
    		<img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="200x200" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzBEOEZEQiI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjEwMCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojZmZmO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEzcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MjAweDIwMDwvdGV4dD48L3N2Zz4=">
    		<h4>Label</h4>
    		<span class="text-muted">Something else</span>
    	</div>
    	<div class="col-xs-4 col-sm-4 placeholder">
    		<img data-src="holder.js/200x200/auto/vine" class="img-responsive" alt="200x200" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzM5REJBQyI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjEwMCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojMUUyOTJDO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEzcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MjAweDIwMDwvdGV4dD48L3N2Zz4=">
    		<h4>Label</h4>
    		<span class="text-muted">Something else</span>
        </div>
        <div class="col-xs-4 col-sm-4 placeholder">
        	<img data-src="holder.js/200x200/auto/sky" class="img-responsive" alt="200x200" src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMDAiIGhlaWdodD0iMjAwIj48cmVjdCB3aWR0aD0iMjAwIiBoZWlnaHQ9IjIwMCIgZmlsbD0iIzBEOEZEQiI+PC9yZWN0Pjx0ZXh0IHRleHQtYW5jaG9yPSJtaWRkbGUiIHg9IjEwMCIgeT0iMTAwIiBzdHlsZT0iZmlsbDojZmZmO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1zaXplOjEzcHg7Zm9udC1mYW1pbHk6QXJpYWwsSGVsdmV0aWNhLHNhbnMtc2VyaWY7ZG9taW5hbnQtYmFzZWxpbmU6Y2VudHJhbCI+MjAweDIwMDwvdGV4dD48L3N2Zz4=">
        	<h4>Label</h4>
        	<span class="text-muted">Something else</span>
        </div>

    </div> -->
</div>