<?php defined("SYSPATH") or die("No direct script access.");
/**
 * Gallery - a web based photo album viewer and editor
 * Copyright (C) 2000-2008 Bharat Mediratta
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or (at
 * your option) any later version.
 *
 * This program is distributed in the hope that it will be useful, but
 * WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street - Fifth Floor, Boston, MA  02110-1301, USA.
 */
class watermark_Core {
  public static function get_add_form() {
    for ($i = 1; $i <= 100; $i++) {
      $range[$i] = $i;
    }

    $form = new Forge("admin/watermarks/add", "", "post");
    $group = $form->group("add_watermark")->label(_("Upload Watermark"));
    $group->upload("file")->label(_("Watermark"))->rules("allow[jpg,png,gif]|size[1MB]|required");
    $group->dropdown("position")->label(_("Watermark Position"))
      ->options(self::positions())
      ->selected("southeast");
    $group->dropdown("transparency")->label(_("Transparency Percent"))
      ->options($range)
      ->selected(100);
    $group->submit(_("Upload"));
    return $form;
  }

  public static function get_edit_form() {
    for ($i = 1; $i <= 100; $i++) {
      $range[$i] = $i;
    }

    $form = new Forge("admin/watermarks/edit", "", "post");
    $group = $form->group("edit_watermark")->label(_("Edit Watermark"));
    $group->dropdown("position")->label(_("Watermark Position"))
      ->options(self::positions())
      ->selected(module::get_var("watermark", "position"));
    $group->dropdown("transparency")->label(_("Transparency Percent"))
      ->options($range)
      ->selected(module::get_var("watermark", "transparency"));
    $group->submit(_("Modify"));
    return $form;
  }

  public static function get_delete_form() {
    $form = new Forge("admin/watermarks/delete", "", "post");
    $group = $form->group("delete_watermark")->label(_("Delete Watermark"));
    $group->submit(_("Delete"));
    return $form;
  }

  public static function positions() {
    return array("northwest" => _("Northwest"),
                 "north" => _("North"),
                 "northeast" => _("Northeast"),
                 "west" => _("West"),
                 "center" => _("Center"),
                 "east" => _("East"),
                 "southwest" => _("Southwest"),
                 "south" => _("South"),
                 "southeast" => _("Southeast"));
  }

  public static function position($key) {
    $positions = self::positions();
    return $positions[$key];
  }
}