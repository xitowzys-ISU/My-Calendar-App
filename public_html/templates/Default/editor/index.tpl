<body>
    <div class="panel">
        <form action="/editor" method="POST">
            <div class="mb-3">
                {ERROR_TOPIC}
                <label class="form-label">Тема</label>
                <input type="text" name="topic" class="form-control" value="{POST_FIRSTNAME}" placeholder="Уборка по комнате">
            </div>

            <div class="mb-3">
                <label class="form-label">Тип</label>
                <select name="type" class="form-select" aria-label="Default select example">
                    <option value="1" selected>Встреча</option>
                    <option value="2">Звонок</option>
                    <option value="3">Совещание</option>
                    <option value="4">Дело</option>
                </select>

            </div>

            <div class="mb-3">
                <label class="form-label">Место</label>
                <input type="text" class="form-control" name="place" placeholder="Россия, г. Петрозаводск, Молодежный пер., д. 23 кв.196">
            </div>

            <div class="mb-3">
                <label class="form-label">Дата</label>
                <input type="text" class="form-control" id="date" name="datetime" placeholder="Дата" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Длительность</label>
                <input type="text" class="form-control" id="duration" name="duration" placeholder="Длительность"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">Комментарий</label>
                <textarea class="form-control" name="comment" rows="3"></textarea>
            </div>

            <div>
                <button type="submit" class="btn btn-success">Добавить</button>
                <button type="button" class="btn btn-danger">Отмена</button>
            </div>

    </form>
</div>
</body>