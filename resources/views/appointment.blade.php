<div>
    <h2>Programari</h2>
             
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Nume</th>
          <th>Data</th>
          <th>Ora</th>
        </tr>
      </thead>
      <tbody>
      @foreach ($appointments as $a)
        <tr>
        <td>{{ $a->id }}</td>
        <td>{{ $a->nume }}</td>
        <td>{{ $a->data }}</td>
        <td>{{ $a->ora }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>