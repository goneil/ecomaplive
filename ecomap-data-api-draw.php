<div class="container" style="margin-bottom: 50px;">
    <h2>EcoMap Data API</h2>
    <br/>
    <h4> Map Variables </h4>
    TimeStamp is Epoch time (Unix time, using 1/1/1970 as origin)
    For a reference, please see <a HREF= "http://www.epochconverter.com/"> Epoch Time
    converter</a>
    Latitude and logitude are in decimal degrees (not degrees, minutes, seconds)
    Radius is in meters
    Value is a raw sensor value (the default range is normalized 0 to 1)
    <br/>
    <br/>
    Example:<br/>
    00000001358209282.250,+42.353862,-071.090968,80,0.2<br/>
    00000001358209283.500,+42.353862,-071.090968,80,0.3
    <br/>
    <br/>
    You can download a sample data file <a
    HREF="http://localhost/images/data_files/example.txt"> here. </a>
    <br/>
    <br/>
    <h4> Working with Multi-parameter Sensor Data </h4>

    <br/>
    <ul>
        <li>
            If you are collecting data that contains multiple sensor values (for example
            temperature, humidity, Ozone, Carbon Monoxide, Z-acceleration, etc.) then you
            must first preprocess the data to separate your data into SINGLE sensor value
            data.
        </li>
        <li>
            You can then create a separate Eco-Map project for each parameter.  For
            example, all the data points from the ozone gas measurements would get uploaded
            into the "Ozone" project, and all the Carbn Monoxide data points would get
            uploaded into the "Carbon monoxide" project, etc.
        </li>
        <li> 
            To avoid errors, you should make sure that all the data points within the
            same project are all of the same type.  for example, you should not mix ozone
            data and carbon monoxide data into the data project.  You should create a
            separate project for each sensor data type.
        </li>
        <li>
            if you follow these guidelines, it will be very easy for you to create
            arbitrary maps and animations that are meaningful.
        </li>
    </ul>

    <br/>
    <h4> Normalize vs Absolute Data </h4>

    <br/>
    <ul>
        <li>
            The "Create Map" function on this web site will let you create a map that
            uses either normalized or absolute data.  In order to avoid strange rendering
            errors, you should make sure that all of the data points within a given project
            are all using the same scale.  For example, all the data points can be
            normalized (0 to 1) or they can all be in metric units or units of ugrams per
            cubic meter. but whatever scale and units are chosen, all the data points within
            the same project should all use the same units and same scale.  Otherwise, you
            will have some strange artifacts when generating a map or plot.
        </li>
        <li>
            The maps and plots generated by this web site provide the ability to set
            the plotting scale and min and max of the plot.
        </li>
    </ul>
</div>