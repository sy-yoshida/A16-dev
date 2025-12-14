<div class="header">
    <h2>検索条件を変更</h2>
</div>

<div class="setting-content content checked">
    <form action="">
        <!-- 日付入力欄 -->
        <div class="date-setting">
            <h3 class="form-guide">1. 日時の指定</h3>
            <p>表示させたいデータの日付を指定します。</p>

            <p>検索する日時</p>
            <div class="date-form start-date">
                <input type="date">
                <select name="hour" id="">
                    <?php for ($i = 0; $i < 24; $i++) : ?>
                        <option value=<?= $i ?>><?= $i ?>時</option>
                    <?php endfor; ?>
                </select>
                <select name="minute" id="">
                    <?php for ($i = 0; $i < 60; $i += 5) : ?>
                        <option value=<?= $i ?>><?= str_pad($i, 2, 0, STR_PAD_LEFT) ?>分</option>
                    <?php endfor ?>
                </select>
                <span>から</span>
            </div>
            <div class="date-form end-date">
                <input type="date">
                <select name="hour" id="">
                    <?php for ($i = 0; $i < 24; $i++) : ?>
                        <option value=<?= $i ?>><?= $i ?>時</option>
                    <?php endfor; ?>
                </select>
                <select name="minute" id="">
                    <?php for ($i = 0; $i < 60; $i += 5) : ?>
                        <option value=<?= $i ?>><?= str_pad($i, 2, 0, STR_PAD_LEFT) ?>分</option>
                    <?php endfor ?>
                </select>
                <span>まで</span>
            </div>
        </div>

        <!-- 検査機に関する設定欄 -->
         div.
    </form>
</div>
