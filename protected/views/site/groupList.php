<nav id="groupsNav">
    <div>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#groupModal">
            &#43;add group
        </button>
        <div class="pagination">
            <button class="prevPage">
                <span>&laquo;</span>
            </button>

            <div>
                <span class="pageNumber">1</span>
                <span>&#x2F;</span>
                <span class="numberOfPages">1</span>
            </div>

            <button class="nextPage">
                <span>&raquo;</span>
            </button>
        </div>
    </div>

    <div class="groupList">
    </div>

    <div>
        <button class="myGroups">My groups</button>
        <div>
            <input type="radio" name="myGroups" value="all" checked/>
            <input type="radio" name="myGroups" value="inProgress"/>
            <input type="radio" name="myGroups" value="planned"/>
        </div>
    </div>
</nav>
