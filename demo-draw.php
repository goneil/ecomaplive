<h2>Demo map</h2>
<p style="margin: 0px 0px 15px 0px;">On this page, you can enter a short list of data points and create a map. To access more advanced mapping functions and upload larger data sets, please <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/login/">login</a> or <a href="http://<?php echo $_SERVER['HTTP_HOST'];?>/register/">create an account</a>.
You can also view our <a href="">demo video</a> if you want more information.
</p>
<div style="padding: 0px 0px 25px 10px;">
<?php
echo '<div id="map-screen">';
printMapScript(0,array('demo'=>true, 'width'=>500));
echo '</div>';
update_map($_SESSION['points']);
?>
<form method="post" class="form-horizontal">
    <div id="demo-div">
    <div class="pull-left">
        <div class="control-group">
            <label class="control-label">Latitude:</label> 
            <div class="controls">
                <input placeholder="e.g. 42.33" name='lat[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Longitude:</label> 
            <div class="controls">
                <input placeholder="e.g. -71.43"  name='lng[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Radius (meters):</label> 
            <div class="controls">
                <input placeholder="e.g. 20" name='radius[]' />
            </div>
        </div>
        </br>
        </br>
        <div class="control-group">
            <label class="control-label">Latitude:</label> 
            <div class="controls">
                <input placeholder="e.g. 42.33" name='lat[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Longitude:</label> 
            <div class="controls">
                <input placeholder="e.g. -71.43"  name='lng[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Radius (meters):</label> 
            <div class="controls">
                <input placeholder="e.g. 20" name='radius[]' />
            </div>
        </div>
        </br>
        </br>
    </div>
    <div class="pull-left">
        <div class="control-group">
            <label class="control-label">Latitude:</label> 
            <div class="controls">
                <input placeholder="e.g. 42.33" name='lat[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Longitude:</label> 
            <div class="controls">
                <input placeholder="e.g. -71.43"  name='lng[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Radius (meters):</label> 
            <div class="controls">
                <input placeholder="e.g. 20" name='radius[]' />
            </div>
        </div>
        </br>
        </br>
        <div class="control-group">
            <label class="control-label">Latitude:</label> 
            <div class="controls">
                <input placeholder="e.g. 42.33" name='lat[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Longitude:</label> 
            <div class="controls">
                <input placeholder="e.g. -71.43"  name='lng[]' />
            </div>
        </div>
        <div class="control-group">
            <label class="control-label">Radius (meters):</label> 
            <div class="controls">
                <input placeholder="e.g. 20" name='radius[]' />
            </div>
        </div>
            <input name='demo' value="Add points" type="submit" />
            <input name='delete' value="Delete all points" type="submit"/>
    </div>
</div>
</form>
</div>
