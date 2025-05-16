<div class="card-body">
    <form action="" method="get">
        <div class="row">

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="sort_by">Sorting</label>
                    <select class="form-control" name="sort_by" id="sort_by">
                        <option selected value="name">Name</option>
                        <option value="id">Id</option>
                        <option value="created_at">Created_at</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="order_by">Order By</label>
                    <select class="form-control" name="order_by" id="order_by">
                        <option selected value="asc">ASC</option>
                        <option value="desc">DESC</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="limit_by">Limit By</label>
                    <select class="form-control" name="limit_by" id="per_page">
                        <option selected value="5">5</option>
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-2">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" name="status" id="status">
                        <option selected value="active">Active</option>
                        <option value="inactive">Not Active</option>
                    </select>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="form-group">
                    <label for="keyword">Search</label>
                    <input type="search" name="keyword" class="form-control" placeholder="search here" id="keyword">
                </div>
            </div>

            <div class="col-lg-1">
                <label for="">-Search</label>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Search</button>
                </div>
            </div>
        </div>
    </form>
</div>