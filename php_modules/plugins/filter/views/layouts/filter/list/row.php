<tr>
    <td>
        <input class="checkbox-item" type="checkbox" name="ids[]" value="<?php echo $this->item['id']; ?>">
    </td>
    <td>
        <a href="<?php echo $this->link_form . '/' . $this->item['id']; ?>"><?php echo  $this->item['name']  ?></a>
    </td>
    <td><?php echo $this->item['created_at'] ?></td>
</tr>
