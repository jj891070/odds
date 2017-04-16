<div id="odd">
    <table>
        <thead>
          <tr>
            <th>玩法</th>
            <th>賠率</th>
          </tr>
        </thead>
        <tbody>
            @foreach($data as $item)
                <tr>
                    <td>{{ $item['market'] }}</td>
                    <td>
                        <!-- 5秒內1秒閃一次 -->
                        <span
                            @if($item['refresh'] && time() % 2 == 0)
                            style="color:red;"
                            @endif
                        >
                        {{ $item['price'] }}
                        </span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
