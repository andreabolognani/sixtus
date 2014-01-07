
$(DIRECT_MAP_FILE): $(ACCESS_MAP_FILE)
	@echo "Copying direct map file"
	@mkdir -p $(dir $@)
	@$(CP) $< $@

$(REVERSE_MAP_FILE): $(DIRECT_MAP_FILE)
	@echo "Generating reverse map file"
	@mkdir -p $(dir $@)
	@$(PHP) -f $(DMAP_TO_RMAP) $< $@

maps-clean:
	@$(RM) $(DIRECT_MAP_FILE) $(REVERSE_MAP_FILE)
