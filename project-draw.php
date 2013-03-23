<script src="/images/js/project.js" type="text/javascript"></script>
<div id="container">
    <div id="container-header">
        <div id="last">
            <button>last</button>
        </div>
        <div id="container-title">
            Projects
        </div>

        <div class="button-container">
            <button id="add">Add Project</button>
        </div>
    </div>
    <div id="container-body">
        <div id="search-container">
            <form id="search">
                <div>
                    Search:
                    <input id="search-box" name="search-box" value type="text">
                </div>
            </form>
        </div>
        <ul id="search-content">
            <?php
		            $projs = getUserProjects($userInfo['uid']);
                    show_project_list($projs);
            ?>
        </ul>

    </div>
</div>
