<div class="header">
    <h2>検索条件を変更</h2>
</div>

<div class="search-content content checked">
    <form id="dataForm">
        <div class="flex">
            <!-- 日付入力欄 -->
            <div class="search-content-parts date-search">
                <h3 class="form-guide">1. 日時の指定</h3>
                <p class="sub-sentence">調べたいデータの日付を指定します</p>

                <p>検索する日時</p>
                <div class="date-form start-date">
                    <input name="start_date[day]" type="date">
                    <select name="start_date[hour]" id="">
                        <?php for ($i = 0; $i < 24; $i++) : ?>
                            <option value=<?= $i ?>><?= $i ?>時</option>
                        <?php endfor; ?>
                    </select>
                    <select name="start_date[minute]" id="">
                        <?php for ($i = 0; $i < 60; $i += 5) : ?>
                            <option value=<?= $i ?>><?= str_pad($i, 2, 0, STR_PAD_LEFT) ?>分</option>
                        <?php endfor ?>
                    </select>
                    <span>から</span>
                </div>
                <div class="date-form end-date">
                    <input name="end_date[day]" type="date">
                    <select name="end_date[hour]" id="">
                        <?php for ($i = 0; $i < 24; $i++) : ?>
                            <option value=<?= $i ?>><?= $i ?>時</option>
                        <?php endfor; ?>
                    </select>
                    <select name="end_date[minute]" id="">
                        <?php for ($i = 0; $i < 60; $i += 5) : ?>
                            <option value=<?= $i ?>><?= str_pad($i, 2, 0, STR_PAD_LEFT) ?>分</option>
                        <?php endfor ?>
                    </select>
                    <span>まで</span>
                </div>
            </div>

            <!-- 検査機に関する入力欄 -->
            <div class="search-content-parts machine-search">
                <h3 class="form-guide">2. 検査機の状態</h3>
                <p class="sub-sentence">検査機に関する情報を見ることができます</p>
                <div class="machine-form">
                    <label class="checkbox">
                        <input type="checkbox" name="machine[]" value="pressure">
                        <span>検査圧</span>
                    </label>
                    <p class="explain">※ 検査圧が正常に加わっているかを確認できます</p>

                    <label class="checkbox">
                        <input type="checkbox" name="machine[]" value="adjust">
                        <span>アジャスト値</span>
                    </label>
                    <p class="explain">※ アジャストが正常に動作しているかを確認できます</p>
                </div>
            </div>
        </div>

        <!-- 対象製品の入力欄 -->
        <div class="search-content-parts product-search">
            <h3 class="form-guide">3. 対象製品</h3>
            <p class="sub-sentence">指定した製品の良品率を見ることができます</p>

            <div class="product-form">

                <label for="product-all" class="checkbox">
                    <input name="product[choice]" type="checkbox" id="product-all" value="all">
                    <span>すべての製品を見る</span>
                </label>

                <label for="product-material" class="checkbox">
                    <input name="product[choice]" type="checkbox" id="product-material" value="material">
                    <span>材質ごとで見る</span>
                </label>

                <label for="product-diameter" class="checkbox">
                    <input name="product[choice]" type="checkbox" id="product-diameter" value="diameter">
                    <span>口径ごとで見る</span>
                </label>

                <label for="product-filter" class="checkbox">
                    <input name="product[choice]" type="checkbox" id="product-filter" value="filter">
                    <span>製品を指定する</span>
                </label>

                <div class="flex filter-detail">
                    <!-- サイズ選択 -->
                    <div class="product-select product-size">
                        <p>サイズ：</p>
                        <label class="checkbox">
                            <input type="checkbox" value="all">
                            <span>すべて選択</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[size]" type="checkbox" value="5">
                            <span>5</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[size]" type="checkbox" value="10">
                            <span>10</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[size]" type="checkbox" value="16">
                            <span>16</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[size]" type="checkbox" value="20">
                            <span>20</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[size]" type="checkbox" value="150">
                            <span>150</span>
                        </label>
                    </div>

                    <!-- 材質選択 -->
                    <div class="product-select product-material">
                        <p>材質：</p>
                        <label class="checkbox">
                            <input type="checkbox" value="all">
                            <span>すべて選択</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[material]" type="checkbox" value="UB">
                            <span>UB</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[material]" type="checkbox" value="UBM">
                            <span>UBM</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[material]" type="checkbox" value="UBO">
                            <span>UBO</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[material]" type="checkbox" value="SHB">
                            <span>SHB</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[material]" type="checkbox" value="UHB">
                            <span>UHB</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[material]" type="checkbox" value="LURT">
                            <span>LURT</span>
                        </label>
                        <label class="checkbox">
                            <input name="product[material]" type="checkbox" value="UBSD">
                            <span>UBSD</span>
                        </label>
                    </div>

                    <!-- 口径選択 -->
                    <div class="product-diameter">
                        <p>口径：</p>
                        <div class="flex">
                            <!-- Aサイズ選択 -->
                            <div class="product-select A-diameter">
                                <p class="size-sentence">Aサイズ</p>
                                <label class="checkbox">
                                    <input type="checkbox" value="all">
                                    <span>すべて選択</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[A-diameter]" type="checkbox" value="40">
                                    <span>40</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[A-diameter]" type="checkbox" value="50">
                                    <span>50</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[A-diameter]" type="checkbox" value="65">
                                    <span>65</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[A-diameter]" type="checkbox" value="80">
                                    <span>80</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[A-diameter]" type="checkbox" value="100">
                                    <span>100</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[A-diameter]" type="checkbox" value="125">
                                    <span>125</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[A-diameter]" type="checkbox" value="150">
                                    <span>150</span>
                                </label>
                            </div>
                            <!-- Bサイズ選択 -->
                            <div class="product-select B-diameter">
                                <p class="size-sentence">Bサイズ</p>
                                <label class="checkbox">
                                    <input type="checkbox" value="all">
                                    <span>すべて選択</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[B-diameter]" type="checkbox" value="2">
                                    <span>2</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[B-diameter]" type="checkbox" value="21/2">
                                    <span>2 1/2</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[B-diameter]" type="checkbox" value="3">
                                    <span>3</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[B-diameter]" type="checkbox" value="4">
                                    <span>4</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[B-diameter]" type="checkbox" value="5">
                                    <span>5</span>
                                </label>
                                <label class="checkbox">
                                    <input name="product[B-diameter]" type="checkbox" value="6">
                                    <span>6</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 検索ボタン -->
        <button class="search-btn" type="submit">
            <img src="images/search/search-btn-icon.png" alt="">
            <span>検索する</span>
        </button>
    </form>
</div>
