<nav id="groupsNav">
    <div>
        <?php if (Yii::app()->user->type === 'itacademy'): ?>
        <button type="button" class="btn btn-default" data-toggle="modal" data-target="#groupModal">
            &#43; add group
        </button>
        <?php endif; ?>

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
        <?php if (Yii::app()->user->type === 'itacademy'): ?>
        <button class="myGroupListBtn">My groups</button>
        <div>
            <input type="radio" name="myGroups" value="finished"/>
            <input type="radio" name="myGroups" value="current" checked/>
            <input type="radio" name="myGroups" value="future"/>
        </div>
        <?php endif; ?>
    </div>

</nav>
