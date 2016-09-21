<h3>Notes and Instructions</h3>
<div class="col-md-10 panel panel-default">
    <div class="panel-body">
    	<ul>
    		<li>
    			This is the development environment, so feel free to change anything you want and add any cases you want.
    		</li>
    		<li>
    			You should be able to edit two or more cases in different tabs, in case you want to copy and paste.
    		</li>
    		<li>
    			It is better to create the course and lesson on the WP side first, so you'll have the course post id and the lesson post id.  The easiest way to get them is in the url when you are on the course or lesson in WP admin.
    		</li>
    		<li>
    			In the lesson post, put the shortcode [php snippet=2] (it's [php snippet=1] on production).  The php snippet will take care of the rest.
    		</li>
    		<li>
    			Before a case can be used by a user, a slug will be necessary.  Use letters, dashes and underscores only.
    		</li>
    		<li>
    			There is a section called Videos.  It is per case, obviously.  It may be helpful to go there and add all the video names and descriptions before editing other pages, as other pages will have a dropdown where you can select from these videos.
    		</li>
    		<li>
    			I've tried to indicate where full urls are needed and where file names only are needed.  In general, images need a full url and videos are selected from a dropdown.  If there is a place to put a video file name, only put the name.  The system will get the full url from General Settings for videos.
    		</li>
    		<li>
    			You will find some options that can't be deleted.  These options need to be present or it breaks the front end.  For instance, in management the option to do nothing is always present so it can disable all other options on the frontend.
    		</li>
    		<li>
    			Creating a new case inserts a lot of records into the database to set up the case's pages.  Currently, there is no way to delete an entire case for that reason, and if people have gone through the case you don't want to delete it anyway or else there will be a lot of user answers that don't link to anything.
    		</li>
    	</ul>
    </div>
</div>
