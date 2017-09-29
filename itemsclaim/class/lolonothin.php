
        //         case 'searchdate':

        // $ctrr = 1;
        // $searchhehe = "SELECT DISTINCT card_id, item_description, owner_name, notes, important, quantity, claim_date, item_time, item_status FROM items_claim_deposit WHERE card_id LIKE '%" .$_POST['claimdate']. "%' or item_description LIKE '" .$_POST['search']. "%' or owner_name LIKE '%" .$_POST['search']. "%' or notes LIKE '%" .$_POST['search']. "%' or important LIKE '%" .$_POST['search']."%' or quantity LIKE '%" .$_POST['search']."' or claim_date LIKE '%" .$_POST['search']. "%' HAVING item_status ='Deposited' AND claim_date = CURDATE()";
        // $resultsearch = mysqli_query($conn, $searchhehe);
        // while($row = mysqli_fetch_array($resultsearch)){
        //      echo "<tr>
        //                 <td>" .$ctrr."</td>
        //                 <td>" .$row['card_id']. "</td>
        //                 <td>" .$row['owner_name']. "</td>
        //                 <td>" .$row['item_description']. "</td>
        //                 <td>" .$row['notes']. "</td>
        //                 <td>" .$row['important']. "</td>
        //                 <td>" .$row['quantity']. "</td>
        //                 <td>" .$row['claim_date']. "</td>
        //                 <td>" .$row['item_time']. "</td>
        //                 <td style='text-align: center;'><a href='#' title='Claim' onclick='updatehehe();' data-pjax='0'><button class='btn btn-success' type='button'> Claim </button></a></td> 
        //         </tr>";

        //         $ctrr++;
        // }
        // break;