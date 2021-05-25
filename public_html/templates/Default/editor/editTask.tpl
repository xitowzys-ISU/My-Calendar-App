<body>
    <div class="panel">
        <form action="/editor/edit-task" method="POST">
            <div class="mb-3">
                {ERROR_TOPIC}
                <label class="form-label">Тема</label>
                <input type="text" name="topic" class="form-control" value="{TOPIC}" placeholder="Уборка по комнате">
            </div>

            <div class="mb-3">
                <label class="form-label">Тип</label>
                <select name="type" class="form-select" aria-label="Default select example">
                    <option value="1" {SELECT_TYPE[Встреча]}>Встреча</option>
                    <option value="2" {SELECT_TYPE[Звонок]}>Звонок</option>
                    <option value="3" {SELECT_TYPE[Совещание]}>Совещание</option>
                    <option value="4" {SELECT_TYPE[Дело]}>Дело</option>
                </select>

            </div>

            <div class="mb-3">
                {ERROR_PLACE}
                <label class="form-label">Место</label>
                <input type="text" class="form-control" value="{LOCATION}" name="place" placeholder="Россия, г. Петрозаводск, Молодежный пер., д. 23 кв.196">
            </div>

            <div class="mb-3">
                {ERROR_DATE}
                <label class="form-label">Дата</label>
                <input type="text" class="form-control" value="{DATE}" id="date" name="datetime" placeholder="Дата" required>
            </div>

            <div class="mb-3">
                {ERROR_DURATION}
                <label class="form-label">Длительность</label>
                <input type="text" class="form-control" value="{DURATION}" id="duration" name="duration" placeholder="Длительность"
                    required>
            </div>

            <div class="mb-3">
                {ERROR_COMMENT}
                <label class="form-label">Комментарий</label>
                <textarea class="form-control" name="comment" rows="3">{COMMENT}</textarea>
            </div>

            <div>
                <button type="submit" name="editTask" value="{ID}" class="btn btn-warning">Изменить</button>
                <a href="/"><button type="button" class="btn btn-danger">Отмена</button></a>
            </div>

    </form>
</div>
</body>